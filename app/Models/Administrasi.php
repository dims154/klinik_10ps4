<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;

    protected $table = 'administrasis';

    /**
     * Mass Assignment
     */
    protected $fillable = [
        'user_id',
        'tanggal',
        'pasiens_id',
        'dokter_id',
        'biaya',
    ];

    /**
     * Relasi ke User (pemilik data)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Pasien
     */
    public function pasien()
    {
        return $this->belongsTo(Pasiens::class, 'pasiens_id');
    }

    /**
     * Relasi ke Dokter
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }
}