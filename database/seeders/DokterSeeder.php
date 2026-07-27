<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dokter;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user pertama
        $admin = User::first();

        if (!$admin) {
            $this->command->error('Belum ada data user.');
            return;
        }

        // Hapus data dokter lama milik user
        Dokter::where('user_id', $admin->id)->delete();

        $dokters = [
            [
                'kode_dokter' => 'DK001',
                'nama_dokter' => 'dr. Andi Saputra',
                'spesialis'   => 'Dokter Umum',
                'nomor_hp'    => '081200000001',
            ],
            [
                'kode_dokter' => 'DK002',
                'nama_dokter' => 'dr. Budi Santoso',
                'spesialis'   => 'Dokter Anak',
                'nomor_hp'    => '081200000002',
            ],
            [
                'kode_dokter' => 'DK003',
                'nama_dokter' => 'dr. Citra Lestari',
                'spesialis'   => 'Penyakit Dalam',
                'nomor_hp'    => '081200000003',
            ],
            [
                'kode_dokter' => 'DK004',
                'nama_dokter' => 'dr. Dewi Kartika',
                'spesialis'   => 'Dokter Gigi',
                'nomor_hp'    => '081200000004',
            ],
            [
                'kode_dokter' => 'DK005',
                'nama_dokter' => 'dr. Eka Pratama',
                'spesialis'   => 'THT',
                'nomor_hp'    => '081200000005',
            ],
        ];

        foreach ($dokters as $dokter) {

            Dokter::create([
                'user_id'      => $admin->id,
                'kode_dokter'  => $dokter['kode_dokter'],
                'nama_dokter'  => $dokter['nama_dokter'],
                'spesialis'    => $dokter['spesialis'],
                'nomor_hp'     => $dokter['nomor_hp'],
            ]);

        }

        $this->command->info('✓ 5 data dokter berhasil dibuat.');
    }
}