<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ch_user', function (Blueprint $table) {
            $table->id('id_ch');
            $table->foreignId('id_user')
                  ->constrained('users')   // relasi ke tabel users
                  ->onDelete('cascade');   // kalau user dihapus, data ini ikut terhapus
            $table->string('fullname');
            $table->text('address');
            $table->unsignedTinyInteger('age');
            $table->string('phone', 20);
            $table->decimal('weight', 5, 1);  // contoh: 55.5 kg
            $table->decimal('height', 5, 1);  // contoh: 160.0 cm
            $table->enum('statusPregnant', ['hamil', 'tidak_hamil']);
            $table->string('gestationalAge')->nullable(); // null kalau tidak hamil
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ch_user');
    }
};