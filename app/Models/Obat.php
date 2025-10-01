<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';

    protected $fillable = [
        'nama', 'jenis_obat', 'bentuk_obat', 'kategori_dosis', 'stock', 'dosis_per_hari'
    ];

    // Relasi ke Kunjungan
    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class);
    }
}
