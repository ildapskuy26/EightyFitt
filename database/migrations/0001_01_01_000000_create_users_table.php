<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');                  // nama pengguna
            $table->string('email')->unique();       // email unik
            $table->string('password')->nullable();  // bisa null kalau pakai login sosial
            $table->string('provider')->nullable();  // misal: google, github, dsb
            $table->string('provider_id')->nullable(); // ID dari provider
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
