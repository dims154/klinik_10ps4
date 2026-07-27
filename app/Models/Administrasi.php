<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;

    protected $table = 'administrasis';

    protected $fillable = [
        'user_id',
        'tanggal',
        'pasiens_id',
        'dokter_id',
        'biaya',
    ];

    /**
     * Relasi User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi Pasien
     */
    public function pasien()
    {
        return $this->belongsTo(Pasiens::class, 'pasiens_id');
    }

    /**
     * Relasi Dokter
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }
}