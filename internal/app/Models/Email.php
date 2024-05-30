<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'tipe_email',
        'nama_email',
    ];

    protected $dates = ['deleted_at'];

    public function koresponden()
    {
        return $this->belongsTo(Koresponden::class, 'id_koresponden');
    }

    public function mengirim()
    {
        return $this->hasMany(Mengirim::class);
    }
}
