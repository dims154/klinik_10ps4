<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('pasiens')->insert([
            [
                'kode_pasien'   => '01',
                'nama_pasien'   => 'Budi Rahmad',
                'jenis_kelamin' => 'Laki-Laki',
                'status'        => 'Belum Kawin',
                'alamat'        => 'Thehok'
            ],
            [
                'kode_pasien'   => '02',
                'nama_pasien'   => 'Jhon',
                'jenis_kelamin' => 'Laki-Laki',
                'status'        => 'Belum Kawin',
                'alamat'        => 'Thehok'
            ],
            
        ]);
    }
}
