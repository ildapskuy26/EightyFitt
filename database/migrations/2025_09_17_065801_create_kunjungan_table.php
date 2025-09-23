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
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 20);
            $table->string('nama', 100);
            $table->string('kelas', 50)->nullable();
            $table->string('jurusan', 50)->nullable();
            $table->dateTime('waktu_kedatangan');
            $table->dateTime('waktu_keluar')->nullable();
            $table->text('keluhan')->nullable();
            $table->unsignedBigInteger('obat_id')->nullable();
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('obat_id')->references('id')->on('obat')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan');
    }
};
