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
        Schema::table('tanggapan', function (Blueprint $table) {
            // Only add columns if they don't already exist (avoid duplicate column errors)
            if (!Schema::hasColumn('tanggapan', 'email')) {
                $table->string('email')->after('nama');
            }

            if (!Schema::hasColumn('tanggapan', 'subjek')) {
                $table->enum('subjek', ['konsultasi', 'pengaduan', 'saran'])->after('email')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tanggapan', function (Blueprint $table) {
            // Drop columns only if they exist
            if (Schema::hasColumn('tanggapan', 'subjek')) {
                $table->dropColumn('subjek');
            }

            if (Schema::hasColumn('tanggapan', 'email')) {
                $table->dropColumn('email');
            }
        });
    }
};
