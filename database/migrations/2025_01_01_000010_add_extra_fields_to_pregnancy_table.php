<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pregnancy', function (Blueprint $table) {
            // Khusus ANC1 / kunjungan pertama
            $table->date('hpht')->nullable()->after('gestational_age');
            $table->decimal('height', 5, 1)->nullable()->after('weight');

            // Setiap kunjungan
            $table->unsignedSmallInteger('systolic')->nullable()->after('height');
            $table->unsignedSmallInteger('diastolic')->nullable()->after('systolic');
            $table->decimal('lila', 4, 1)->nullable()->after('diastolic');
            $table->boolean('took_iron_supplement')->nullable()->after('lila');
        });
    }

    public function down(): void
    {
        Schema::table('pregnancy', function (Blueprint $table) {
            $table->dropColumn(['hpht', 'height', 'systolic', 'diastolic', 'lila', 'took_iron_supplement']);
        });
    }
};
