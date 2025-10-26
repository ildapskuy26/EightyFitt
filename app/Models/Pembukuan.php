<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembukuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'periode',
        'jenis_periode',
        'total_kunjungan',
        'total_obat',
        'obat_hampir_habis',
        'obat_terdistribusi',
        'ringkasan_kunjungan',
        'ringkasan_obat'
    ];

    protected $casts = [
        'ringkasan_kunjungan' => 'array',
        'ringkasan_obat' => 'array',
        'periode' => 'date'
    ];
}
