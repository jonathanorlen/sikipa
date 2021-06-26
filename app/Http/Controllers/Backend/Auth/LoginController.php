<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Penduduk;
use App\Models\polling;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;

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

    public function authenticate(Request $request)
    {   
        $this->validate($request,$this->rules());
        $user = User::where('email', $request['email'])
            ->first();
            
        if($user && Hash::check($request['password'], $user->password))
        {
            $request->session()->put('user', $user);
 
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->withError("Email atau Password Salah");
        }
    }

    public function logout() {
        Session::flush('user');
        return redirect()->route('admin.login');
    }

}
