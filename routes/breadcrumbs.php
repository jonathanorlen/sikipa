<?php

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// Dashboard > User
Breadcrumbs::for('user', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('User', route('user.index'));
});

// Dashboard > User > Create
Breadcrumbs::for('user.create', function ($trail) {
    $trail->parent('user');
    $trail->push('Tambah', route('user.create'));
});

// Dashboard > Penduduk
Breadcrumbs::for('penduduk', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Penduduk', route('penduduk.index'));
});

// Dashboard > Penduduk > Detail
Breadcrumbs::for('penduduk.detail', function ($trail, $penduduk) {
    $trail->parent('penduduk');
    $trail->push($penduduk->nama, route('penduduk.show', $penduduk->nik));
});

// // Home > Blog > [Category]
// Breadcrumbs::for('category', function ($trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category->id));
// });

// // Home > Blog > [Category] > [Post]
// Breadcrumbs::for('post', function ($trail, $post) {
//     $trail->parent('category', $post->category);
//     $trail->push($post->title, route('post', $post->id));
// });