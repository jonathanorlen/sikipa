<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penduduk;
use Session;
use DB;

class MainController extends Controller
{   
    protected function rules($penduduk, $request)
    {
        $rules =  [
            
            'nomor_kk' => 'required|exists:kartu_keluarga,nomor_kk',
            'nama' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'umur' => 'required',
            'alamat' => 'required',
            'kelurahan' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'agama' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'golongan_darah' => 'nullable',
            'status_keluarga' => 'required',
            'status_perkawinan' => 'required',
            'kewarganegaraan' => 'required',
            'ayah' => 'nullable',
            'ibu' => 'nullable',
            'ktp' =>  'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        
        if($penduduk->nik != $request->nik){
            $rules['nik'] =  'required|unique:penduduk,nik';
        }

        if($penduduk->email != $request->email){
            $rules['email'] =  'nullable|email:rfc,dns|unique:penduduk,email';
        }

        return $rules;
    }

    public function index(){
        return view('frontend.pages.index');
    }
    
    public function register(){
        return view('frontend.pages.register');
    }

    public function login(){
        return view('frontend.pages.login');
    }

    public function dashboard(){
        return view('frontend.pages.dashboard');
    }

    public function profile(Request $request){
        $data['data'] = Penduduk::get()->where('id',$request->session()->get('id'))->first();
        $data['kelurahan'] = DB::select('select * from kelurahan');
        $data['rt'] = DB::select('select * from rt');
        $data['rw'] = DB::select('select * from rw');

        $data['kartu_keluarga'] = DB::select('select * from kartu_keluarga');
        $data['pekerjaan'] = DB::select('select * from master_pekerjaan');
        $data['edit'] = true;
        return view('frontend.pages.profile', $data);
    }

    public function profileUpdate(Penduduk $penduduk, Request $request){
        $data = $this->validate($request, $this->rules($penduduk, $request));

        try {
            $penduduk->update($data);
            $request->session()->put('penduduk', $penduduk);
            return redirect()->route('user.profile')->withSuccess("Profile Berhasil Di Update");
        } catch (Exception $e) {
            return redirect()->route('user.profile')->withError($e);
        }
    }

    public function logout(){
        Session::flush('penduduk');
        return redirect()->route('login');
    }

}
