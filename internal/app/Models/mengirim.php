<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class mengirim extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Nonaktifkan auto-incrementing karena kita tidak memiliki kolom "id"
    public $incrementing = false;

    // Nonaktifkan timestamps jika tidak diperlukan
    public $timestamps = true;

    // Tentukan bahwa primary keys bukan integer
    protected $keyType = 'string';

    // Tentukan primary keys
    protected $primaryKey = ['id_berita', 'id_email'];

    // Override metode untuk mendukung composite keys
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }

        foreach ($keys as $key) {
            $query->where($key, '=', $this->getAttribute($key));
        }

        return $query;
    }

    protected $fillable = [
        'id_berita',
        'id_email',
        'tanggal_kirim_berita',
        'respon_time',
        'role',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function email()
    {
        return $this->belongsTo(Email::class, 'id_email');
    }

    public function berita()
    {
        return $this->belongsTo(Berita::class, 'id_berita');
    }
}
