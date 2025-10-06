<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaTableSeeder extends Seeder
{
    public function run(): void
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // matikan FK

    Siswa::truncate(); // hapus semua data

    \DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // hidupkan FK lagi

        Siswa::create(['nis' => '18692', 'nama' => 'ABI DZAR AL GIFAHRI', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18693', 'nama' => 'ADAM FADHILLA PUTRA KAMAL', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18694', 'nama' => 'AHMAD BAIHAQI', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18695', 'nama' => 'AHMAD FADLI APRIANSYAH', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18696', 'nama' => 'ALVIA SETYANI PUTRI', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18697', 'nama' => 'AMMAR ALIF NURFAJRI', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18698', 'nama' => 'ARYA BIMA NUGRAHA', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18699', 'nama' => 'ATHIYYAH SYIFA', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18700', 'nama' => 'AUREL RAMDANI', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18701', 'nama' => 'AZMAR SYIFA AZRA', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18702', 'nama' => 'BIMO RAFA TRAYUDA', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18703', 'nama' => 'EFANDRA FLAVIAN NASUTION', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18704', 'nama' => 'FAHRI AHMAD SYAFIQ', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18705', 'nama' => 'FAJAR HALIM AMANAH', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18706', 'nama' => 'FARIZ RIZKI NURRAHMAN', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18707', 'nama' => 'GUNTUR NUR DIAWAN', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18708', 'nama' => 'HIQMA RIANG ANANTIMAR', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18709', 'nama' => 'I GUSTI AGUNG LINGGAM PUTRA KEPAKISAN', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18710', 'nama' => 'MOEAMAR HAMZAH OMAR OLLIE', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18711', 'nama' => 'MOHAMAD RAKHA ZAIDAN', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18712', 'nama' => 'MUHAMAD RIFKI ALFARIZEY', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18713', 'nama' => 'MUHAMMAD ADNAN FADHILLAH', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18714', 'nama' => 'MUHAMMAD AKMAL FADLI', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18715', 'nama' => 'MUHAMMAD FIRAS SYAFIQ', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18716', 'nama' => 'MUHAMMAD RAFLY AL-GYBRAN', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18717', 'nama' => 'NADHIEF YOGA RAMADHAN', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18718', 'nama' => 'NAURAH HANIYAH PRAMESTARI', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18719', 'nama' => 'RIGEL SATRYANSYAH', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18720', 'nama' => 'RIZKI KHOIRUL AZZAM', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18721', 'nama' => 'SAFANA KHALISTA ANDRIANTO', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18722', 'nama' => 'SALSABILA AULIA', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18723', 'nama' => 'ULFIYAH NAJWATSANA GHOFUR', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18724', 'nama' => 'WISANGGENI GAGAH RAMADHAN', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18725', 'nama' => 'YAZID ALFA', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18726', 'nama' => 'ZAKI FARREL AHMADINEJAD', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
        Siswa::create(['nis' => '18727', 'nama' => 'DAVID KURNIA YUNANTO', 'kelas' => '12-RPL', 'jurusan' => 'RPL']);
    }
}