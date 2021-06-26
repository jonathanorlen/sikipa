<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
     protected function rules()
     {
         return [
             'nama' => ['required', 'string', 'max:255'],
             'nik' => ['required', 'numeric', 'digits:16'],
             'alamat' => ['required', 'string', 'max:50'],
             'rt' => ['required', 'numeric', 'max:100'],
             'rw' => ['required', 'numeric', 'max:100'],
             'email' => ['required', 'string', 'email', 'max:255', 'unique:penduduk'],
             'password' => ['required', 'string', 'min:8'],
         ];
     }
 
     /**
      * Create a new user instance after a valid registration.
      *
      * @param  array  $data
      * @return \App\User
      */
     protected function create(Request $data)
     {    
          $validated = $data->validate($this->rules());
          
          $penduduk = Penduduk::create([
               'nama' => $data['nama'],
               'nik' => $data['nik'],
               'alamat' => $data['alamat'],
               'rt' => $data['rt'],
               'rw' => $data['rw'],
               'email' => $data['email'],
               'password' => Hash::make($data['password']),
          ]);

          $data->session()->put('penduduk', $penduduk);

         return redirect()->route('dashboard');
     }
}
