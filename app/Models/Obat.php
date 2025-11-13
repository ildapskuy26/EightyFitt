<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kunjungan; // ✅ tambahkan ini

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';

    protected $fillable = [
        'nama',
        'jenis_obat',
        'bentuk_obat',
        'dosis_per_hari',
        'stock',
        'kadar',
        'stok_terpakai',
    ];

    protected $attributes = [
        'stok_terpakai' => 0,
    ];

    // Relasi ke Kunjungan
    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class);
    }

    public function getStokTersisaAttribute()
    {
        return $this->stock - $this->stok_terpakai;
    }

}
