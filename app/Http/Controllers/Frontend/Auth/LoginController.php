<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;

class LoginController extends Controller
{

    private function rules($id = false){
        return  [
            'email'                 =>  'required',
            'password'            =>  'required',
        ];
    }

    public function index() {
        return view('backend.pages.login');   
    }

    public function authenticate(Request $request) {
        $data = $this->validate($request,$this->rules());
        $penduduk = DB::table('penduduk')
            ->where('email', $data['email'])
            ->orWhere('nik', $data['email'])
            ->first();
        if($penduduk && Hash::check($data['password'], $penduduk->password))
        {
            $request->session()->put('penduduk', $penduduk);
            return redirect()->route('user.dashboard');
        } else {
            return redirect()->route('login')->withError("Email atau Password Salah");
        }
    }


}
