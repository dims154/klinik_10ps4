<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;

    protected $table = 'administrasis';

    protected $fillable = [
        'tanggal',
        'pasien_id',
        'dokter_id',
        'biaya',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasiens::class, 'pasien_id', 'id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id', 'id');
    }
}