<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Koresponden extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nama_koresponden'
    ];

    protected $dates = ['deleted_at'];

    public function emails()
    {
        return $this->hasMany(Email::class, 'id_koresponden');
    }
}
