<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {

        Siswa::create([
            'nama' => 'Rifki Hutan Gundul',
            'nis' => '13579',
            'kelas' => 'XII TU 69',
            'jurusan' => 'Tanpa Busana',
            'riwayat_penyakit' => 'Tidak ada',
        ]);
    }
}
