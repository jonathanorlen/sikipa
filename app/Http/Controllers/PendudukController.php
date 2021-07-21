<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Carbon;
use Str;

class PendudukController extends Controller
{
    protected function rules($id = false)
    {
        $rules =  [
            
            'nomor_kk' => 'required|exists:kartu_keluarga,nomor_kk',
            'nama' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'kategori_penduduk' => 'required',
            'alamat' => 'required',
            'kelurahan' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'agama' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'kategori_penduduk' => 'required',
            'golongan_darah' => 'nullable',
            'status_keluarga' => 'required',
            'status_perkawinan' => 'required',
            'kewarganegaraan' => 'required',
            'email' => 'nullable|email:rfc,dns|unique:penduduk,email',
            'ayah' => 'nullable',
            'ibu' => 'nullable',
            'ktp' =>  'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        if($id == false){
            $rules['nik'] =  'required|unique:penduduk,nik';
        }
        return $rules;
    }

    public function index(Request $request)
    {   
        $data['kelurahan'] = DB::select('select * from kelurahan');
        $data['items'] = Penduduk::orderBy('nama', 'asc')
            ->where('nama', 'like', '%' . $request->search . '%')
            ->get();

        return view('backend.pages.penduduk', $data);
    }


    public function create()
    {   
        $data['kelurahan'] = DB::select('select * from kelurahan');
        $data['kartu_keluarga'] = DB::select('select * from kartu_keluarga');
        $data['pekerjaan'] = DB::select('select * from master_pekerjaan');
        $data['form'] = "create";
        return view('backend.pages.penduduk-form', $data);
    }


    public function store(Request $request)
    {   
        $data = $this->validate($request, $this->rules());
        try {
            if ($request->hasfile('ktp')) {
                $data['ktp'] = $this->upload_image($request->file('ktp'), null);
            }else{
                $data['ktp'] ='../default.jpg';
            }
            $data['golongan_darah'] =  strtoupper($request->golongan_darah);
            $data['password'] = Hash::make(strtolower(str_replace(' ', '', $request->tempat_lahir)).Carbon::parse($request->tanggal_lahir)->format('dmY'));
            Penduduk::create($data);
            return redirect()->route('admin.penduduk.index')->withSuccess('Penduduk ' . $request['nama'] . ' telah ditambahkan');
        } catch (Exception $e) {
            return redirect()->route('admin.penduduk.index')->withError($e);
        }
    }


    public function show(Penduduk $penduduk)
    {
        $data['data'] = $penduduk;
        $data['kelurahan'] = DB::select('select * from kelurahan');
        $data['rt'] = DB::select('select * from rt');
        $data['rw'] = DB::select('select * from rw');

        $data['kartu_keluarga'] = DB::select('select * from kartu_keluarga');
        $data['pekerjaan'] = DB::select('select * from master_pekerjaan');
        $data['edit'] = true;
        return view('backend.pages.penduduk-form', $data);
    }


    public function edit(Penduduk $penduduk)
    {
        $data['item'] = $penduduk;
        $data['edi'] = true;
        return view('backend.pages.penduduk-form', $data);
    }


    public function update(Request $request, Penduduk $penduduk)
    {   
        if($penduduk->nik == $request->nik){
            $id = true;
        }else{
            $id = false;
        }

        $data = $this->validate($request, $this->rules($id));
        try {
            if ($request->hasfile('ktp')) {
                $data['ktp'] = $this->upload_image($request->file('ktp'), $penduduk->ktp);
            }
            $data['golongan_darah'] =  strtoupper($request->golongan_darah);
            $penduduk->update($data);
            return redirect()->route('admin.penduduk.index')->withSuccess('User terupdate');
        } catch (Exception $e) {
            return redirect()->route('admin.penduduk.index')->withError($e);
            // return Redirect::to('sharks/create')
            //     ->withErrors($validator)
            //     ->withInput(Input::except('password'))
        }
    }

    public function save_status(Request $request, Penduduk $penduduk)
    {
        try {
            $data['catatan'] = $request->catatan;
            $data['dokumen_kk'] = $request->dokumen_kk;
            $data['dokumen_ktp'] = $request->dokumen_ktp;
            $penduduk->update($data);
            return redirect()->route('admin.penduduk.index')->withSuccess('User Status Terupdate');
        } catch (Exception $e) {
            return redirect()->route('admin.penduduk.index')->withError($e);
            // return Redirect::to('sharks/create')
            //     ->withErrors($validator)
            //     ->withInput(Input::except('password'))
        }
    }

    public function change_status(Penduduk $penduduk)
    {
        $data['item'] = $penduduk;
        return view('backend.pages.penduduk-status', $data);
    }


    public function destroy($nik)
    {   
        $penduduk = Penduduk::findOrFail($nik);
        try {
            $this->delete_image($penduduk->ktp);
            $penduduk->delete();
            return redirect()->back()->withSuccess('Penduduk ' . $penduduk->name . ' Berhasil Dihapus');
        } catch (Exception $e) {
            return redirect()->back()->withError($e);
        }
    }

    private function upload_image($image, $old_image = null)
    {
        $path = base_path('public/images/ktp/');
        $path_old_image = $path . $old_image;
        if ($old_image && file_exists($path_old_image) && ($old_image != '../default.jpg')) {
            unlink($path_old_image);
        }
        $image_name = Str::random(30) . '.' . $image->getClientOriginalExtension();
        $image->move($path, $image_name);
        return $image_name;
    }

    private function delete_image($image)
    {   
        if ($image != '..default.jpg' && $image != null) {
            unlink(base_path('public/images/ktp/') . $image);
        }
    }
}
