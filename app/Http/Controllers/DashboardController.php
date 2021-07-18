<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class DashboardController extends Controller
{
    public function index(){
        // dd(Session::get('user', 'name'));
        $data['penduduk'] = DB::table('penduduk')->selectRaw('count(*)');
        $data['laki'] = DB::table('penduduk')->where('jenis_kelamin','=','Laki-Laki')->selectRaw('count(*)');
        $data['perempuan'] = DB::table('penduduk')->where('jenis_kelamin','=','Perempuan')->selectRaw('count(*)');
        $data['keluarga'] = DB::table('kartu_keluarga')->selectRaw('count(*)');
        $data['user'] = DB::table('users')->selectRaw('count(*)');
        return view('backend.pages.dashboard',$data);
    }
}
