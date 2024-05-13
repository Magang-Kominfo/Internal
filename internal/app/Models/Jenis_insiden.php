<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_insiden extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_jenis_insiden';
    protected $fillable = [
        'nama_insiden',
        'deskripsi_insiden',
    ];

    public function insidens(){
        return $this->hasMany(Insiden::class,'insidens_id_jenis_insiden_foreign');
    }
}
