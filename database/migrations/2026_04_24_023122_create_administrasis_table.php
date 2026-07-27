<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('administrasis', function (Blueprint $table) {

            $table->id();

            // Pemilik data
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->date('tanggal');

            // Relasi ke pasien
            $table->foreignId('pasiens_id')
                  ->constrained('pasiens')
                  ->cascadeOnDelete();

            // Relasi ke dokter
            $table->foreignId('dokter_id')
                  ->constrained('dokters')
                  ->cascadeOnDelete();

            $table->integer('biaya');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('administrasis');
    }
};