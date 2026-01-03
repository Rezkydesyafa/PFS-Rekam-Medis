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
        Schema::create('rekammedis_obat', function (Blueprint $table) {
            $table->id('id_rm_obat');
            $table->unsignedBigInteger('id_rekammedis');
            $table->unsignedBigInteger('id_obat');
            $table->integer('jumlah');
            $table->string('aturan_pakai');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_rekammedis')->references('id_rekammedis')->on('rekam_medis')->onDelete('cascade');
            $table->foreign('id_obat')->references('id_obat')->on('obats')->onDelete('cascade');

            // Composite unique key to prevent duplicates
            $table->unique(['id_rekammedis', 'id_obat']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekammedis_obat');
    }
};
