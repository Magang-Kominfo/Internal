<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Master_odp extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $primaryKey = 'odp_id';
    protected $fillable = [
        'nama_instansi',
    ];

    public function insidens(){
        return $this->hasMany(Insiden::class,'insidens_odp_id_foreign');
    }
}
