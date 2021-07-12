<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\KartuKeluargaController;

Route::get('login', [LoginController::class, 'index'])->name('admin.login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('admin.authenticate');

Route::middleware('is_admin')
     ->name('admin.')
     ->group(function () {
          Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

          //User route with resource except no index
          Route::resource('user', UserController::class)->except([
               'index'
          ]);
          Route::get('user/{search?}', [UserController::class, 'index'])->name('user.index');

          //Penduduk route with resource except no index
          Route::resource('penduduk', PendudukController::class)->except([
               'index'
          ]);
          Route::get('penduduk/{search?}', [PendudukController::class, 'index'])->name('penduduk.index');

          Route::resource('kelurahan', KelurahanController::class)->except([
               'index'
          ]);
          Route::get('kelurahan/{search?}', [KelurahanController::class, 'index'])->name('kelurahan.index');

          Route::get('kelurahan/{kelurahan}/rw', [KelurahanController::class, 'rw_index'])->name('rw');
          Route::post('kelurahan/rw/store', [KelurahanController::class, 'rw_store'])->name('rw.store');
          Route::delete('kelurahan/{rw}/destroy', [KelurahanController::class, 'rw_destory'])->name('rw.destroy');


          Route::get('kelurahan/{kelurahan}/{rw}', [KelurahanController::class, 'rt_index'])->name('rt');
          Route::post('kelurahan/rt/store', [KelurahanController::class, 'rt_store'])->name('rt.store');
          Route::delete('kelurahan/{rt}/rt/destroy', [KelurahanController::class, 'rt_destory'])->name('rt.destroy');
          
          Route::resource('kartu-keluarga', KartuKeluargaController::class)->except([
               'index'
          ]);
          Route::get('kartu-keluarga/card', [KartuKeluargaController::class, 'card'])->name('kartu-keluarga.card');
          Route::post('kartu-keluarga/import', [KartuKeluargaController::class, 'import'])->name('kartu-keluarga.import');
          Route::get('kartu-keluarga/{search?}', [KartuKeluargaController::class, 'index'])->name('kartu-keluarga');
          
          Route::get('rw', [KelurahanController::class, 'rw'])->name('getrw');
          Route::get('rt', [KelurahanController::class, 'rt'])->name('getrt');

          Route::get('logout', [LoginController::class, 'logout'])->name('logout');
     });
