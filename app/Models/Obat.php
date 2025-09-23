<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';

    protected $fillable = [
        'nama', 'jenis', 'bentuk', 'kategori_dosis', 'stock'
    ];

    // Relasi ke Kunjungan
    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class);
    }
}
