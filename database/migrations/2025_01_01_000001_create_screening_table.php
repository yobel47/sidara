<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('screening', function (Blueprint $table) {
            $table->id('id_screening');
            $table->foreignId('id_user')
                ->constrained('users')
                ->onDelete('cascade');
            $table->date('date_screening');
            $table->decimal('weight', 5, 1);      // berat badan kg, contoh: 55.5
            $table->decimal('height', 5, 1);      // tinggi badan cm, contoh: 160.0
            $table->decimal('hemoglobin', 4, 1);  // kadar Hb g/dL, contoh: 10.8
            $table->text('complaint');            // keluhan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('screening');
    }
};