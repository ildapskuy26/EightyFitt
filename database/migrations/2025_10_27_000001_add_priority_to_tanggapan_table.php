<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tanggapan', function (Blueprint $table) {
            if (!Schema::hasColumn('tanggapan', 'priority')) {
                $table->string('priority')->default('normal')->after('status');
            }
        });
    }

    public function down()
    {
        Schema::table('tanggapan', function (Blueprint $table) {
            if (Schema::hasColumn('tanggapan', 'priority')) {
                $table->dropColumn('priority');
            }
        });
    }
};
