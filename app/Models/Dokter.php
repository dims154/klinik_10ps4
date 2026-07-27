<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    /**
     * Nama tabel
     */
    protected $table = 'dokters';

    /**
     * Mass Assignment
     */
    protected $fillable = [
        'user_id',
        'kode_dokter',
        'nama_dokter',
        'spesialis',
        'nomor_hp',
    ];

    /**
     * Relasi ke User
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