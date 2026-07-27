<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasiens extends Model
{
    use HasFactory;

    /**
     * Nama tabel
     */
    protected $table = 'pasiens';

    /**
     * Mass Assignment
     */
    protected $fillable = [
        'user_id',
        'kode_pasien',
        'nama_pasien',
        'jenis_kelamin',
        'status',
        'alamat',
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
        return $this->hasMany(Administrasi::class, 'pasien_id');
    }
}