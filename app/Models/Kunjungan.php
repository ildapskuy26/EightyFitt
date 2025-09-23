<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Siswa;
use App\Models\Obat;

class Kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungan';

    protected $fillable = [
        'nis', 'nama', 'kelas', 'jurusan', 'waktu_kedatangan',
        'waktu_keluar', 'keluhan', 'obat_id'
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
