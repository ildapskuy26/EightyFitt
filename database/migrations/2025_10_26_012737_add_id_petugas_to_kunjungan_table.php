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
    Schema::table('kunjungan', function (Blueprint $table) {
        $table->unsignedBigInteger('id_petugas')->nullable()->after('obat_id');
        $table->foreign('id_petugas')->references('id')->on('users')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('kunjungan', function (Blueprint $table) {
        $table->dropForeign(['id_petugas']);
        $table->dropColumn('id_petugas');
    });
}

};
