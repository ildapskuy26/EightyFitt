<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kunjungan', function (Blueprint $table) {
    if (!Schema::hasColumn('kunjungan', 'tempat')) {
        $table->string('tempat', 50)->after('obat_id');
    }

    if (!Schema::hasColumn('kunjungan', 'id_petugas')) {
        $table->unsignedBigInteger('id_petugas')->nullable()->after('tempat');
    }
});

    }

    public function down(): void
    {
        Schema::table('kunjungan', function (Blueprint $table) {
            $table->dropForeign(['id_petugas']);
            $table->dropColumn(['tempat', 'id_petugas']);
        });
    }
};
