<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pasiens;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user pertama
        $admin = User::first();

        if (!$admin) {
            $this->command->error('Belum ada data user.');
            return;
        }

        // Hapus data lama milik user
        Pasiens::where('user_id', $admin->id)->delete();

        $dataPasien = [
            ['PS001','Ahmad Fauzi','Laki-laki','Umum','Jl. Sultan Thaha No.1 Jambi'],
            ['PS002','Siti Aisyah','Perempuan','BPJS','Jl. Pattimura No.2 Jambi'],
            ['PS003','Rudi Hartono','Laki-laki','Umum','Jl. Hayam Wuruk No.3 Jambi'],
            ['PS004','Dewi Lestari','Perempuan','BPJS','Jl. Kolonel Abunjani No.4 Jambi'],
            ['PS005','Bambang Setiawan','Laki-laki','Umum','Jl. Orang Kayo Hitam No.5 Jambi'],
            ['PS006','Nurhaliza','Perempuan','BPJS','Jl. Gajah Mada No.6 Jambi'],
            ['PS007','Andi Pratama','Laki-laki','Umum','Jl. Sudirman No.7 Jambi'],
            ['PS008','Rina Marlina','Perempuan','BPJS','Jl. Gatot Subroto No.8 Jambi'],
            ['PS009','Yoga Saputra','Laki-laki','Umum','Jl. Soekarno Hatta No.9 Jambi'],
            ['PS010','Putri Ayu','Perempuan','BPJS','Jl. Ahmad Yani No.10 Jambi'],
            ['PS011','Doni Saputra','Laki-laki','Umum','Jl. Lingkar Selatan No.11 Jambi'],
            ['PS012','Fitri Handayani','Perempuan','BPJS','Jl. Basuki Rahmat No.12 Jambi'],
            ['PS013','Rizki Maulana','Laki-laki','Umum','Jl. Hos Cokroaminoto No.13 Jambi'],
            ['PS014','Indah Permata','Perempuan','BPJS','Jl. Diponegoro No.14 Jambi'],
            ['PS015','Aldi Prakoso','Laki-laki','Umum','Jl. Jend. Sudirman No.15 Jambi'],
            ['PS016','Maya Sari','Perempuan','BPJS','Jl. KH Wahid Hasyim No.16 Jambi'],
            ['PS017','Rahmat Hidayat','Laki-laki','Umum','Jl. Prof. Sri Soedewi No.17 Jambi'],
            ['PS018','Nabila Putri','Perempuan','BPJS','Jl. Cempaka No.18 Jambi'],
            ['PS019','Fajar Nugroho','Laki-laki','Umum','Jl. Melati No.19 Jambi'],
            ['PS020','Lina Oktavia','Perempuan','BPJS','Jl. Kenanga No.20 Jambi'],
        ];

        foreach ($dataPasien as $pasien) {

            Pasiens::create([
                'user_id'        => $admin->id,
                'kode_pasien'    => $pasien[0],
                'nama_pasien'    => $pasien[1],
                'jenis_kelamin'  => $pasien[2],
                'status'         => $pasien[3],
                'alamat'         => $pasien[4],
            ]);
        }

        $this->command->info('✓ 20 data pasien berhasil dibuat.');
    }
}