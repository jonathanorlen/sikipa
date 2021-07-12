<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RW extends Model
{
    use HasFactory;

    protected $table = 'rw';

    protected $fillable = [
        'kelurahan_id',
        'nomor_rw',
    ];

    public function rts()
    {
        return $this->hasMany(RT::class, 'rw_id', 'id');
    }
}
