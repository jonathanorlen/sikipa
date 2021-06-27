<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class DashboardController extends Controller
{
    public function index(){
        // dd(Session::get('user', 'name'));
        return view('backend.pages.dashboard');
    }
}
