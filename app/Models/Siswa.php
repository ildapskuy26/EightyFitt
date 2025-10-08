<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'siswa';

    protected $fillable = [
        'nama',
        'nis',
        'kelas',
        'jurusan',
        'tinggi_badan',
        'berat_badan',
        'riwayat_penyakit',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Otomatis hash password hanya jika belum di-hash.
     */
    public function setPasswordAttribute($value)
    {
        if (!$value) {
            return;
        }

        // Cegah hashing ulang jika password sudah di-hash
        if (Str::startsWith($value, '$2y$')) {
            $this->attributes['password'] = $value;
        } else {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    /**
     * Relasi ke tabel kunjungan.
     * Asumsi: tabel 'kunjungan' memiliki kolom 'nis' sebagai foreign key.
     */
    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class, 'nis', 'nis');
    }
}
            