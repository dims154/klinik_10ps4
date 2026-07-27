<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $fillable = [
        'user_id',
        'kode_dokter',
        'nama_dokter',
        'spesialis',
        'nomor_hp',
    ];

    /**
     * Relasi ke User (pemilik data)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Administrasi
     */
    public function administrasis()
    {
        return $this->hasMany(Administrasi::class, 'dokter_id');
    }
}