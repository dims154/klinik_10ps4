<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = [
        'kode_pasien',
        'nama_pasien',
        'jenis_kelamin',
        'status',
        'alamat',
    ];
}