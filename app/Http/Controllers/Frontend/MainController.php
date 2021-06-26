<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penduduk;
use Session;

class MainController extends Controller
{
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
        $data['item'] = Penduduk::get()->where('id',$request->session()->get('id'))->first();
        // dd($data['item']);
        return view('frontend.pages.profile', $data);
    }

    public function logout(){
        Session::flush('penduduk');
        return redirect()->route('login');
    }

}
