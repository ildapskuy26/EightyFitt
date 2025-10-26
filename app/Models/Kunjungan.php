<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungan';

    protected $fillable = [
        'nis', 'nama', 'kelas', 'jurusan',
        'waktu_kedatangan', 'waktu_keluar',
        'keluhan', 'obat_id', 'tempat', 'id_petugas'
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id', 'id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas', 'id');
    }
}
