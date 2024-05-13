<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aset_aplikasi extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id_aset_aplikasi';
    protected $fillable = [
        'kategori_aset_aplikasi',
        'nama_aset_aplikasi',
        'ip_aset_aplikasi',
        'server_aset_aplikasi',
        'indeks_kami_aset_aplikasi'
    ];

    public function jenis_kategoris()
    {
        return $this->belongsTo(Jenis_kategori::class);
    }
}
