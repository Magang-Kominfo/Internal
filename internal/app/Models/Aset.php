<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;
    protected $casts = [
        'images' => 'array'
    ];
    protected $table = 'aset';
    protected $primaryKey = 'id';
        protected $fillable = [
        'nomor_aset',
        'nama',
        'jumlah',
        'pemanfaatan',
        'kondisi',
        'images',

    ];
}
