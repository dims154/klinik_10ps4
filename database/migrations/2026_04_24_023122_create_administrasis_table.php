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

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('tanggal');

            $table->foreignId('pasiens_id')
                ->constrained('pasiens')
                ->cascadeOnDelete();

            $table->foreignId('dokter_id')
                ->constrained('dokters')
                ->cascadeOnDelete();

            $table->decimal('biaya', 12, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('administrasis');
    }
};