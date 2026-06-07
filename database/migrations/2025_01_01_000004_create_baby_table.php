<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baby', function (Blueprint $table) {
            $table->id('id_baby');
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->date('date_birth');
            $table->time('time_birth')->nullable();
            $table->decimal('weight', 4, 2); // kg
            $table->decimal('height', 4, 1); // cm
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baby');
    }
};
