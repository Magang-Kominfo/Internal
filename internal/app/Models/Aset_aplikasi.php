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
        'aa_id_jenis_kategori_foreign',
        'nama_aset_aplikasi',
        'ip_aset_aplikasi',
        'server_aset_aplikasi',
        'indeks_kami_aset_aplikasi'
    ];

    public function jenis_kategoris()
    {
        return $this->belongsTo(Jenis_kategori::class, 'aa_id_jenis_kategori_foreign');
    }
}
