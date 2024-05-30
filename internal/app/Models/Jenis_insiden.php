<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jenis_insiden extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id_jenis_insiden';
    protected $fillable = [
        'nama_insiden',
        'deskripsi_insiden',
    ];

    public function insidens(){
        return $this->hasMany(Insiden::class,'insidens_id_jenis_insiden_foreign');
    }
}
