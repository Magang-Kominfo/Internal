<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insiden extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $primaryKey = 'insiden_id';
    protected $fillable = [
        'insidens_odp_id_foreign',
        'insidens_id_jenis_insiden_foreign',
        'resiko_insiden',
        'status_insiden',
        'status_setelah_unsuspend_insiden',
        'url_insiden',
        'nomor_surat_tte_insiden',
        'keterangan_insiden',
        'tanggal_surat_tte_insiden',
        'tanggal_suspend_insiden',
        'tanggal_pemulihan_insiden',
        'tanggal_insiden_diselesaikan',
        'jam_insiden_diselesaikan',
        'tanggal_notifikasi_insiden',
        'jam_temuan_insiden',
        'jam_temuan_dikirim_insiden',
    ];

    public function master_odps()
    {
        return $this->belongsTo(Master_odp::class,'insidens_odp_id_foreign');
    }

    public function jenis_insidens()
    {
        return $this->belongsTo(Jenis_insiden::class,'insidens_id_jenis_insiden_foreign');
    }
}
