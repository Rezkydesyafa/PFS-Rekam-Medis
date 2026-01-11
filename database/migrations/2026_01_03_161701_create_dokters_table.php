<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dokters', function (Blueprint $table) {
            $table->id('id_dokter');
            $table->string('nama_dokter');
            $table->string('spesialisasi');
            $table->decimal('tarif', 12, 2)->default(0); // Added from 2026_01_11_042715
            $table->string('no_sip')->unique();
            $table->string('no_telepon', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};
