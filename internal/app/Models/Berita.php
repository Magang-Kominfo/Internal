<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Berita extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'no_agenda',
        'id_sifat',
        'id_alur_surat',
        'no_berita',
        'jumlah_halaman_berita',
        'tanggal_buat_berita',
        'isi_berita',
        'dokumen_surat_berita'
    ];

    protected $dates = ['tanggal_buat_berita', 'deleted_at'];

    public function sifat()
    {
        return $this->belongsTo(Sifat::class, 'id_sifat');
    }

    public function alursurat()
    {
        return $this->belongsTo(AlurSurat::class, 'id_alur_surat');
    }

    public function mengirims()
    {
        return $this->hasMany(Mengirim::class, 'id_berita');
    }
}
