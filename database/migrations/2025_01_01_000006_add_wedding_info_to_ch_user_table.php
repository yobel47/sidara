<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ch_user', function (Blueprint $table) {
            $table->date('weddingDate')->nullable()->after('gestationalAge');
            $table->date('marriageDispensationDate')->nullable()->after('weddingDate');
        });
    }

    public function down(): void
    {
        Schema::table('ch_user', function (Blueprint $table) {
            $table->dropColumn(['weddingDate', 'marriageDispensationDate']);
        });
    }
};
