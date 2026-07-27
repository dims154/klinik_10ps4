<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Dokter;
use App\Models\Pasiens;
use App\Models\Administrasi;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * User memiliki banyak Dokter
     */
    public function dokters()
    {
        return $this->hasMany(Dokter::class);
    }

    /**
     * User memiliki banyak Pasien
     */
    public function pasiens()
    {
        return $this->hasMany(Pasiens::class);
    }

    /**
     * User memiliki banyak Administrasi
     */
    public function administrasis()
    {
        return $this->hasMany(Administrasi::class);
    }
}