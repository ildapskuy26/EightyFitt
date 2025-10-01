<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaTableSeeder extends Seeder
{
    public function run(): void
    {
        Siswa::create([
            'nis' => '123456',
            'nama' => 'Siswa Satu',
            'kelas' => 'XII IPA 1',
            'jurusan' => 'IPA',
        ]);
    }
}