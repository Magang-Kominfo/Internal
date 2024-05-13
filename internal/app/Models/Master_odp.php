<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_odp extends Model
{
    use HasFactory;
    protected $primaryKey = 'odp_id';
    protected $fillable = [
        'nama_instansi',
    ];

    public function insidens(){
        return $this->hasMany(Insiden::class,'insidens_odp_id_foreign');
    }
}
