<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nama',
        'nis',
        'kelas',
        'jurusan',
        'riwayat_penyakit',
    ];

    /**
     * Relasi ke tabel kunjungan.
     * Kunjungan punya kolom 'siswa_id'.
     */
    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class, 'siswa_id', 'id');
    }

    /**
     * Relasi ke tabel users.
     * 1 siswa punya 1 akun user (opsional).
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
