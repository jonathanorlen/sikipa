<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Imports\PendudukImport;
use App\Exports\PendudukExport;
// use Maatwebsite\Excel\Facades\Excel;
use DB;
use Excel;
use Validator;
use Str;

class KartuKeluargaController extends Controller
{
    protected function rules()
    {
        $rules = [
            'nomor_kk' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        $rules = [
            'nama.*' => 'required',
            'nik.*' => 'required',
            'foto_ktp.*' => 'required',
            'email.*' => 'nullable',
            'tanggal_lahir.*' => 'required',
            'jenis_kelamin.*' => 'required',
            'umur.*' => 'required',
            'agama.*' => 'required',
            'pendidikan.*' => 'required',
            'pekerjaan.*' => 'required',
            'alamat.*' => 'required',
            'kelurahan.*' => 'required',
            'rw.*' => 'required',
            'rt.*' => 'required',
            'status_keluarga.*' => 'required',
            'status_perkawinan.*' => 'required',
            'kewarganegaraan.*' => 'required',
            'ayah.*' => 'required',
            'ibu.*' => 'required',
            'kategori_penduduk.*' => 'required',
        ];

        return $rules;
    }

    protected function rules_keluarga()
    {
        return [
            'nomor_kk' => ['required', 'string'],
            'foto' => ['required', 'email']
        ];
    }

    public function index(Request $request)
    {
        $data['items'] = KartuKeluarga::orderBy('id', 'desc')->with('anggotKeluarga')->get();
        // $data['items']->appends($request->only('search'));

        return view('backend.pages.kartu_keluarga', $data);
    }
    
    public function list($nomor_kk)
    {   
        $data['nomor_kk'] = $nomor_kk;
        $data['items'] = Penduduk::orderBy('nik', 'asc')->where("nomor_kk", $nomor_kk)->get();

        return view('backend.pages.kartu_keluarga_list', $data);
    }
    
    public function detail($nomor_kk,Penduduk $penduduk)
    {
        $data['data'] = $penduduk;
        return view('backend.pages.kartu_keluarga_anggota_form', $data);
    }


    public function create(Request $request)
    {
        $data['kelurahan'] = DB::select('select * from kelurahan');
        $data['form'] = "create";
        return view('backend.pages.kartu_keluarga_form', $data);
    }


    public function store(Request $req)
    {
        $kk = $req->only('nomor_kk', 'foto');
        $this->validate($req, [
            'nomor_kk' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($req->hasFile('foto')){
            $kk['foto'] = $this->upload_image_kk($req->file('foto'), null);
        }else{
            $kk['foto'] = "../default.jpg";
        }

        KartuKeluarga::create($kk);

        return redirect()->route('admin.kartu-keluarga')->withSuccess('Kartu Keluarga '.$req->nomor_kk.' Telah Dibuat');
    }


    public function show(KartuKeluarga $KartuKeluarga)
    {
        //
    }


    public function edit(KartuKeluarga $KartuKeluarga)
    {
        $data['data'] = $KartuKeluarga;
        $data['edit'] = true;
        return view('backend.pages.kartu_keluarga_form', $data);
    }


    public function update(Request $request, KartuKeluarga $KartuKeluarga)
    {   
        $rules = [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        if($request->nomor_kk != $KartuKeluarga->nomor_kk || $request->nomor_kk == null){
            $rules['nomor_kk'] = 'required|unique:kartu_keluarga,nomor_kk';
        }
        
        $data= $this->validate($request, $rules);

        if ($request->hasfile('foto')) {
            $data['foto'] = $this->upload_image_kk($request->file('foto'), $KartuKeluarga->foto);
        }

        try {
            $KartuKeluarga->update($data);
            return redirect()->route('admin.kartu-keluarga')->withSuccess('KartuKeluarga terupdate');
        } catch (Exception $e) {
            return redirect()->route('admin.kartu-keluarga')->withError($e);
            // return Redirect::to('sharks/create')
            //     ->withErrors($validator)
            //     ->withInput(Input::except('password'))
        }
    }

    public function card()
    {
        $data['kelurahan'] = DB::select('select * from kelurahan');
        $return = view('backend.pages.kartu_keluarga_card', $data)->render();
        return response()->json(array('html' => $return, 'msg' => 'success'));
    }

    public function getExport(Request $req)
    {   

        $data = DB::table('penduduk');
        if($req->agama){
            $data->where('agama','=',$req->agama);
        }

        if($req->pendidikan){
            $data->where('pendidikan','=',$req->pendidikan);
        }

        if($req->status_keluarga){
            $data->where('status_keluarga','=',$req->status_keluarga);
        }

        if($req->pekerjaan){
            $data->where('pekerjaan','=',$req->pekerjaan);
        }

        if($req->kewarganegaraan){
            $data->where('kewarganegaraan','=',$req->kewarganegaraan);
        }

        if($req->jenis_kelamin){
            $data->where('jenis_kelamin','=',$req->jenis_kelamin);
        }

        if($req->umur_awal){
            $data->where('umur','>=',$req->umur_awal);
        }

        if($req->umur_akhir){
            $data->where('umur','<=',$req->umur_akhir);
        }

        return response()->json(array('code' => 200,'jumlah' => $data->count()));
    }

    public function export(Request $request) 
    {
        return Excel::download(new PendudukExport($request), 'penduduk.xlsx');
    }

    public function import(Request $request){
        // validasi
		$rules = array([
			'file' => 'required|mimes:csv,xls,xlsx',
            'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json($error->errors()->all());
        }
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
        $file->move('excel',$nama_file);
        try{
            $import = Excel::import(new PendudukImport, public_path('/excel/'.$nama_file));

            $data = Excel::toCollection(new PendudukImport, public_path('/excel/'.$nama_file));
            $group = $data->first()->groupBy('nomor_kk');
            foreach($group as $key => $item){
                $data['nomor_kk'] = $key;
                KartuKeluarga::firstOrCreate([
                    'nomor_kk' => $key
                ]);
            }
        }catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return response()->json(['code' => '500', 'message' => $failures]);
        }
        
        try{
            unlink(public_path('/excel/'.$nama_file));
            return response()->json(['code' => '200', 'namefile' => $nama_file, 'nama' => $file->getClientOriginalName()]);
        }catch (Throwable $e) {
            return response()->json(['code' => $e]);
        }
    }

    public function destroy(KartuKeluarga $KartuKeluarga)
    {
        try {
            $KartuKeluarga->delete();
            return redirect()->back()->withSuccess('KartuKeluarga ' . $KartuKeluarga->name . ' Berhasil Dihapus');
        } catch (Exception $e) {
            return redirect()->back()->withError($e);
        }
    }

    private function upload_image_kk($image, $old_image = null)
    {
        $path = base_path('public/images/kartu_keluarga/');
        $path_old_image = $path . $old_image;
        if ($old_image && file_exists($path_old_image) && ($old_image != '../default.jpg')) {
            unlink($path_old_image);
        }
        $image_name = Str::random(30) . '.' . $image->getClientOriginalExtension();
        $image->move($path, $image_name);
        return $image_name;
    }
}
