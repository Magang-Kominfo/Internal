<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_kategori extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jenis_kategori';
    protected $fillable = [
        'nama_jenis_kategori',
        'deskripsi_jenis_kategori'
    ];

    public function aset_aplikasis(){
        return $this->hasMany(Aset_aplikasi::class,'aa_id_jenis_kategori_foreign');
    }
}
