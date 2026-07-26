<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasiens extends Model
{
    use HasFactory;

    protected $table = 'pasiens';

    protected $fillable = [
        'kode_pasien',
        'nama_pasien',
        'jenis_kelamin',
        'status',
        'alamat',
    ];

    public function administrasi()
    {
        return $this->hasMany(Administrasi::class, 'pasiens_id', 'id');
    }
}