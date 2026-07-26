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
                'kode_pasiens'   => '01',
                'nama_pasiens'   => 'Budi Rahmad',
                'jenis_kelamin' => 'Laki-Laki',
                'status'        => 'Belum Kawin',
                'alamat'        => 'Thehok'
            ],
            [
                'kode_pasiens'   => '02',
                'nama_pasiens'   => 'Jhon',
                'jenis_kelamin' => 'Laki-Laki',
                'status'        => 'Belum Kawin',
                'alamat'        => 'Thehok'
            ],
            
        ]);
    }
}
