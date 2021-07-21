<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\LoginController as FrontendLogin;
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

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/login', [MainController::class, 'login'])->name('login');
Route::post('/login-authenticate', [FrontendLogin::class, 'authenticate'])->name('login-authenticate');
Route::get('/register', [MainController::class, 'register'])->name('register');
Route::post('/register-store', [RegisterController::class, 'create'])->name('register-create');

Route::prefix('user')
     ->name('user.')
     ->middleware(['is_penduduk'])
     ->group(function () {
          Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');
          Route::get('/profile', [MainController::class, 'profile'])->name('profile');
          Route::post('/update-profile/{penduduk}', [MainController::class, 'profileUpdate'])->name('profile-update');
          Route::get('/logout', [MainController::class, 'logout'])->name('logout');
     });
