<?php

use App\Models\Kelurahan;
// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// Dashboard > User
Breadcrumbs::for('user', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('User', route('admin.user.index'));
});

// Dashboard > User > Create
Breadcrumbs::for('user.create', function ($trail) {
    $trail->parent('user');
    $trail->push('Tambah', route('admin.user.create'));
});

// Dashboard > User > [Edit]
// Breadcrumbs::for('user.edit', function ($trail) {
//     $trail->parent('user');
//     $trail->push('Tambah', route('admin.user.create'));
// });

// Dashboard > Penduduk
Breadcrumbs::for('penduduk', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Penduduk', route('admin.penduduk.index'));
});

// Dashboard > Penduduk > data
Breadcrumbs::for('penduduk.data', function ($trail, $penduduk) {
    $trail->parent('penduduk');
    $trail->push($penduduk->nama, route('admin.penduduk.show', $penduduk->nik));
});

// Dashboard > Kelurahan
Breadcrumbs::for('kelurahan', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Kelurahan', route('admin.kelurahan.index'));
});

// Dashboard > Kelurahan > Create
Breadcrumbs::for('kelurahan.create', function ($trail) {
    $trail->parent('kelurahan');
    $trail->push('Tambah', route('admin.kelurahan.create'));
});

// Dashboard > Kelurahan > [Edit]
Breadcrumbs::for('kelurahan.edit', function ($trail, $kelurahan) {
    $trail->parent('kelurahan');
    $trail->push($kelurahan->kelurahan, route('admin.kelurahan.edit', $kelurahan->kelurahan));
});

// Dashboard > Kelurahan > RW
Breadcrumbs::for('rw', function ($trail, $kelurahan) {
    $trail->parent('dashboard');
    $trail->push('Kelurahan', route('admin.kelurahan.index'));
    $trail->push($kelurahan->kelurahan, route('admin.rw', strtolower($kelurahan->kelurahan)));
});

// Dashboard > Kelurahan > RW > RT
Breadcrumbs::for('rt', function ($trail, $rw) {
    $rw = Kelurahan::where('kelurahan', ucwords($rw))->first();
    $trail->parent('rw', $rw);
    $trail->push('RT');
});

// Dashboard > Kartu Keluarga
Breadcrumbs::for('kartu_keluarga', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Kartu Keluarga', route('admin.kartu-keluarga'));
});

// Dashboard > Kartu Keluarga > Create
Breadcrumbs::for('kartu_keluarga.create', function ($trail) {
    $trail->parent('kartu_keluarga');
    $trail->push('Tambah', route('admin.kartu-keluarga.create'));
});

// Dashboard > Kartu Keluarga > [Edit]
Breadcrumbs::for('kartu_keluarga.edit', function ($trail, $data) {
    $trail->parent('kartu_keluarga');
    $trail->push('Edit', route('admin.kartu-keluarga.edit', $data->nomor_kk));
});

// Dashboard > Kartu Keluarga > [Data KK]
Breadcrumbs::for('kartu_keluarga.list', function ($trail,$nomor_kk) {
    $trail->parent('kartu_keluarga');
    $trail->push($nomor_kk, route('admin.kartu-keluarga.list', $nomor_kk));
});

// Dashboard > Kartu Keluarga > [Data KK] > [Detail]
Breadcrumbs::for('kartu_keluarga.detail', function ($trail,$data) {
    $trail->parent('kartu_keluarga.list', $data->nomor_kk);
    $trail->push($data->nama, route('admin.kartu-keluarga.detail', [$data->nomor_kk, $data->nik]));
});

// Dashboard > Master Pekerjaan
Breadcrumbs::for('pekerjaan', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Master Pekerjaan', route('admin.pekerjaan'));
});

// Dashboard > Master Pekerjaan > Create
Breadcrumbs::for('pekerjaan.create', function ($trail) {
    $trail->parent('pekerjaan');
    $trail->push('Tambah', route('admin.pekerjaan.create'));
});

// Dashboard > Master Pekerjaan > [Edit]
Breadcrumbs::for('pekerjaan.edit', function ($trail, $data) {
    $trail->parent('pekerjaan');
    $trail->push($data->nama, route('admin.pekerjaan.edit', $data->id));
});
