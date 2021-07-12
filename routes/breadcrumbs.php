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

// Dashboard > Penduduk > Detail
Breadcrumbs::for('penduduk.detail', function ($trail, $penduduk) {
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
    $trail->push($data->nomor_kk, route('admin.kartu-keluarga.edit', $data->nomor_kk));
});
