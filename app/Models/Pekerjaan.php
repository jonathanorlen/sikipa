<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{   
    use HasFactory;

    protected $table = "master_pekerjaan";

    protected $fillable = [
        'nama'
    ];

    public function getPenduduk(){
        return $this->hasMany('App\Models\Penduduk', 'pekerjaan', 'nama');
    }
}
