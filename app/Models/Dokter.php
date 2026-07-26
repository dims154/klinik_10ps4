<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
public function administrasi()
{
    return $this->hasMany(Administrasi::class, 'dokter_id');
}    //
}
