<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlurSurat extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_alur_surat',
    ];
}
