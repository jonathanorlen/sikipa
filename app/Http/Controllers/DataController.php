<?php

namespace App\Http\Controllers;

use App\Models\RT;
use App\Models\RW;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Facades\Excel;
use DB;
use Excel;
use Validator;
use Str;

class DataController extends Controller
{
    public function rt(Request $req)
    {
        $rw = RT::where('rw_id', $req->id)->get();
        return $rw;
    }

    public function rw(Request $req)
    {
        $rw = RW::where('kelurahan_id', $req->id)->get();
        return $rw;
    }
}