<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    use HasFactory;

    protected $table = 'kartu_keluarga';
    protected $fillable = [
        'nomor_kk',
        'foto',
    ];

    public function anggotKeluarga()
    {   
        return $this->hasMany('App\Models\Penduduk', 'nomor_kk', 'nomor_kk');
    }
}
