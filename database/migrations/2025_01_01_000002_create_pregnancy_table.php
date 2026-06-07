<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pregnancy', function (Blueprint $table) {
            $table->id('id_pregnancy');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->date('date_pregnancy');
            $table->unsignedSmallInteger('gestational_age'); // minggu
            $table->decimal('hemoglobin', 4, 1);             // g/dL
            $table->decimal('weight', 5, 1);                 // kg
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pregnancy');
    }
};
