<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungan'; // pastikan sesuai di DB

    protected $fillable = [
        'nis', 'nama', 'kelas', 'jurusan',
        'waktu_kedatangan', 'waktu_keluar',
        'keluhan', 'obat_id'
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id', 'id');
    }

    public function siswa()
    {
        // karena relasinya lewat NIS, bukan siswa_id
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }
}
