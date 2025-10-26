<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembukuans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->date('periode');
            $table->enum('jenis_periode', ['bulanan', 'tahunan']);
            $table->integer('total_kunjungan')->default(0);
            $table->integer('total_obat')->default(0);
            $table->integer('obat_hampir_habis')->default(0);
            $table->integer('obat_terdistribusi')->default(0);
            $table->json('ringkasan_kunjungan')->nullable();
            $table->json('ringkasan_obat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembukuans');
    }
};
