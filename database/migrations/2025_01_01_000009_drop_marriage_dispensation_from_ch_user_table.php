<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ch_user', function (Blueprint $table) {
            $table->dropColumn(['isDispensationMarriage', 'marriageDispensationDate']);
        });
    }

    public function down(): void
    {
        Schema::table('ch_user', function (Blueprint $table) {
            $table->boolean('isDispensationMarriage')->default(false)->after('weddingDate');
            $table->date('marriageDispensationDate')->nullable()->after('isDispensationMarriage');
        });
    }
};
