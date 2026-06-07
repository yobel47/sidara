<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('childbirth', function (Blueprint $table) {
            $table->id('id_childbirth');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->date('date_childbirth');
            $table->unsignedSmallInteger('gestational_age');       // minggu
            $table->string('place');                               // tempat persalinan
            $table->enum('type', ['Normal', 'SC']);                // jenis persalinan
            $table->enum('helper', ['Bidan', 'Dokter', 'Dukun', 'Lainnya']);
            $table->enum('condition', ['Sehat', 'Sakit']);         // keadaan ibu
            $table->string('complication')->nullable();            // komplikasi
            $table->text('notes')->nullable();                     // catatan / alasan dirujuk
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('childbirth');
    }
};
