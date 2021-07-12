<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Imports\PendudukImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
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
        $data['items'] = KartuKeluarga::orderBy('id', 'desc')
            ->paginate(2);
        $data['items']->appends($request->only('search'));

        return view('backend.pages.kartu_keluarga', $data);
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
        $this->validate($req, $this->rules());
        $kk['foto'] = $this->upload_image_kk($req->file('foto'), null);

        $devices = $request->device_id;
        $names = $request->name;

        foreach ($devices as $key => $device_value) {
            $devicesS[] = Device::create([
                'device_id' => $device_value,
                'name' => $names[$key]
            ]);
        };

        KartuKeluarga::create($kk);

        return redirect()->route('admin.kartu-keluarga')->withSuccess('Kartu Keluarga Telah Dibuat');
    }


    public function show(KartuKeluarga $KartuKeluarga)
    {
        //
    }


    public function edit(KartuKeluarga $KartuKeluarga)
    {
        $data['item'] = $KartuKeluarga;
        $data['form'] = "edit";
        return view('backend.pages.kartu_keluarga_form', $data);
    }


    public function update(Request $request, KartuKeluarga $KartuKeluarga)
    {
        $this->validate($request, $this->rules());
        try {
            $KartuKeluarga->update([
                'name' => $request['name'],
                'tanggal_lahir' => $request['tanggal_lahir'],
                'email' => $request['email'],
                'password' => Hash::make(date('ddmmyyyy', strtotime($request['tanggal_lahir'])))
            ]);
            return redirect()->route('KartuKeluarga.index')->withSuccess('KartuKeluarga terupdate');
        } catch (Exception $e) {
            return redirect()->route('KartuKeluarga.index')->withError($e);
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

    public function import(Request $request){
        // validasi
		$rules = array(
			'file' => 'required|mimes:csv,xls,xlsx'
        );
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
            // $import = Excel::import(new PendudukImport, public_path('/excel/'.$nama_file));

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
