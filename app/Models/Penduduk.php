<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Penduduk extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    protected $table = 'penduduk';
    protected $primaryKey = 'nik';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nik',
        'nama',
        'nomor_kk',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'umur',
        'alamat',
        'kelurahan',
        'rt',
        'rw',
        'agama',
        'pendidikan',
        'pekerjaan',
        'golongan_darah',
        'status_keluarga',
        'status_perkawinan',
        'kewarganegaraan',
        'ayah',
        'ibu',
        'kategori_penduduk',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
