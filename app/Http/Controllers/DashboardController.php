<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Pekerjaan;
use DB;

class DashboardController extends Controller
{
    public function index(){
        // dd(Session::get('user', 'name'));
        $data['penduduk'] = DB::table('penduduk')->selectRaw('count(*)');
        $data['laki'] = DB::table('penduduk')->where('jenis_kelamin','=','Laki-Laki')->selectRaw('count(*)');
        $data['perempuan'] = DB::table('penduduk')->where('jenis_kelamin','=','Perempuan')->selectRaw('count(*)');
        $data['tetap'] = DB::table('penduduk')->where('kategori_penduduk','=','Tetap')->selectRaw('count(*)');
        $data['kontrak'] = DB::table('penduduk')->where('kategori_penduduk','=','Kontrak')->selectRaw('count(*)');
        $data['pendatang'] = DB::table('penduduk')->where('kategori_penduduk','=','Pendatang')->selectRaw('count(*)');
        $data['kost'] = DB::table('penduduk')->where('kategori_penduduk','=','Anak Kost')->selectRaw('count(*)');
        $data['almarhum'] = DB::table('penduduk')->where('kategori_penduduk','=','Almarhum')->selectRaw('count(*)');
        $data['keluarga'] = DB::table('kartu_keluarga')->selectRaw('count(*)');
        $data['user'] = DB::table('users')->selectRaw('count(*)');
        $data['pekerjaan'] = Pekerjaan::limit(5)->with('getPenduduk')->get();
        return view('backend.pages.dashboard',$data);
    }
}
