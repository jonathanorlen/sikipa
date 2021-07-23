<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\PekerjaanController;
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

          //Penduduk route with resource except no index and destroy
          Route::resource('penduduk', PendudukController::class)->except([
               'index','destroy','update'
          ]);
          Route::put('penduduk/update/{penduduk}', [PendudukController::class, 'update'])->name('penduduk.update');
          Route::get('penduduk/delete/{nik}', [PendudukController::class, 'destroy'])->name('penduduk.destroy');
          Route::get('penduduk/ganti-status/{penduduk}', [PendudukController::class, 'change_status'])->name('penduduk.ganti_status');
          Route::put('penduduk/ganti-status/{penduduk}/update', [PendudukController::class, 'save_status'])->name('penduduk.ganti_status_update');
          Route::get('penduduk/{search?}', [PendudukController::class, 'index'])->name('penduduk.index');

          Route::resource('kelurahan', KelurahanController::class)->except([
               'index'
          ]);
          Route::get('kelurahan/{search?}', [KelurahanController::class, 'index'])->name('kelurahan.index');

          Route::resource('pekerjaan', PekerjaanController::class)->except([
               'index','destroy'
          ]);
          Route::get('pekerjaan/delete/{pekerjaan}', [PekerjaanController::class, 'destroy'])->name('pekerjaan.destroy');
          Route::get('pekerjaan/{search?}', [PekerjaanController::class, 'index'])->name('pekerjaan');


          Route::get('kelurahan/{kelurahan}/rw', [KelurahanController::class, 'rw_index'])->name('rw');
          Route::post('kelurahan/rw/store', [KelurahanController::class, 'rw_store'])->name('rw.store');
          Route::delete('kelurahan/{rw}/destroy', [KelurahanController::class, 'rw_destory'])->name('rw.destroy');

          Route::get('kelurahan/{kelurahan}/{rw}', [KelurahanController::class, 'rt_index'])->name('rt');
          Route::post('kelurahan/rt/store', [KelurahanController::class, 'rt_store'])->name('rt.store');
          Route::delete('kelurahan/{rt}/rt/destroy', [KelurahanController::class, 'rt_destory'])->name('rt.destroy');
          
          Route::get('kartu-keluarga/card', [KartuKeluargaController::class, 'card'])->name('kartu-keluarga.card');
          Route::get('kartu-keluarga/list/{nomor_kk}', [KartuKeluargaController::class, 'list'])->name('kartu-keluarga.list');
          Route::get('kartu-keluarga/list/{nomor_kk}/{penduduk}', [KartuKeluargaController::class, 'detail'])->name('kartu-keluarga.detail');
          Route::get('kartu-keluarga/getexport', [KartuKeluargaController::class, 'getExport'])->name('kartu-keluarga.getexport');
          Route::post('kartu-keluarga/import', [KartuKeluargaController::class, 'import'])->name('kartu-keluarga.import');
          Route::get('kartu-keluarga/export', [KartuKeluargaController::class, 'export'])->name('kartu-keluarga.export');
          Route::resource('kartu-keluarga', KartuKeluargaController::class)->except([
               'index'
          ]);
          Route::get('kartu-keluarga/{search?}', [KartuKeluargaController::class, 'index'])->name('kartu-keluarga');
          
          Route::get('rw', [KelurahanController::class, 'rw'])->name('getrw');
          Route::get('rt', [KelurahanController::class, 'rt'])->name('getrt');

          Route::get('logout', [LoginController::class, 'logout'])->name('logout');
     });
