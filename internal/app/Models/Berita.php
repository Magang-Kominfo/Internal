<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Berita extends Model
{
    // use SoftDeletes;

    protected $fillable = [
        'no_agenda',
        'id_sifat',
        'no_berita',
        'jumlah_halaman_berita',
        'tanggal_buat_berita',
        'isi_berita',
        'dokumen_surat_berita'
    ];

    // protected $primaryKey = 'id_berita';
    // public $incrementing = false;

    // protected $dates = ['deleted_at'];
    protected $dates = ['tanggal_buat_berita'];

    public function sifat()
    {
        return $this->belongsTo(Sifat::class, 'id_sifat');
    }
}
