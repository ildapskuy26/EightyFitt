<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'nis')) {
            $table->string('nis')->nullable()->after('password');
        }
        // Hapus baris role karena sudah ada
    });
}


    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        if (Schema::hasColumn('users', 'nis')) {
            $table->dropColumn('nis');
        }
    });
}

};
