<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nama', 'nis', 'kelas', 'jurusan', 'tinggi_badan', 'berat_badan', 'riwayat_penyakit'
    ];

    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class, 'nis', 'nis');
    }
}
