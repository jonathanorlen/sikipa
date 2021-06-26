<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\LoginController As FrontendLogin;
use App\Http\Controllers\Backend\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class,'index'])->name('index');
Route::get('/login', [MainController::class,'login'])->name('login');
Route::post('/login-authenticate', [FrontendLogin::class,'authenticate'])->name('login-authenticate');
Route::get('/register', [MainController::class,'register'])->name('register');
Route::post('/register-store', [RegisterController::class,'create'])->name('register-create');

Route::prefix('user')
->middleware(['is_penduduk'])
->group(function(){
     Route::get('/dashboard', [MainController::class,'dashboard'])->name('user.dashboard');
     Route::get('/profile', [MainController::class,'profile'])->name('user.profile');
     Route::get('/logout', [MainController::class,'logout'])->name('user.logout');
});


Route::get('admin/login', [LoginController::class,'index'])->name('admin.login');
Route::post('admin/authenticate', [LoginController::class,'authenticate'])->name('admin.authenticate');

Route::prefix('admin')
->middleware(['is_admin'])
->group(function () {
     Route::get('/dashboard', [DashboardController::class,'index'])->name('admin.dashboard');
     
     //User route with resource except no index
     Route::resource('user',UserController::class)->except([
          'index'
      ]);
     Route::get('user/{search?}', [UserController::class,'index'])->name('user.index');
     
     //Penduduk route with resource except no index
     Route::resource('penduduk',PendudukController::class)->except([
          'index'
      ]);
     Route::get('penduduk/{search?}', [PendudukController::class,'index'])->name('penduduk.index');

     Route::get('logout', [LoginController::class,'logout'])->name('admin.logout');
});
