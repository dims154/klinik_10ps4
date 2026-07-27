<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dokter;
use App\Models\Pasiens;
use App\Models\Administrasi;
use Illuminate\Database\Seeder;

class AdministrasiSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ambil user pertama (admin)
        $admin = User::first();

        if (!$admin) {
            $this->command->error('Belum ada user pada tabel users.');
            return;
        }

        // Ambil seluruh dokter & pasien milik admin
        $dokters = Dokter::where('user_id', $admin->id)->get();
        $pasiens = Pasiens::where('user_id', $admin->id)->get();

        if ($dokters->count() == 0) {
            $this->command->error('Data dokter masih kosong.');
            return;
        }

        if ($pasiens->count() == 0) {
            $this->command->error('Data pasien masih kosong.');
            return;
        }

        // Hapus data administrasi lama milik admin
        Administrasi::where('user_id', $admin->id)->delete();

        // Buat 10 transaksi
        for ($i = 1; $i <= 10; $i++) {

            Administrasi::create([
                'user_id'    => $admin->id,
                'tanggal'    => now()->subDays(rand(0, 30)),
                'pasiens_id' => $pasiens->random()->id,
                'dokter_id'  => $dokters->random()->id,
                'biaya'      => rand(100000, 500000),
            ]);
        }

        $this->command->info('✓ 10 data administrasi berhasil dibuat.');
    }
}