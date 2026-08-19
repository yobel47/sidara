<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ch_user', function (Blueprint $table) {
            $table->enum('maritalStatus', ['sudah_menikah', 'belum_menikah'])
                  ->nullable()
                  ->after('gestationalAge');
            $table->boolean('isDispensationMarriage')->default(false)->after('weddingDate');
        });
    }

    public function down(): void
    {
        Schema::table('ch_user', function (Blueprint $table) {
            $table->dropColumn(['maritalStatus', 'isDispensationMarriage']);
        });
    }
};
