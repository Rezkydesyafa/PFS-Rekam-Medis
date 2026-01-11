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
    Schema::create('rekam_medis', function (Blueprint $table) {
        $table->id('id_rm'); // Primary Key Custom
        // Relasi ke Pasien & Dokter
        $table->foreignId('pasien_id')->constrained('pasiens', 'id_pasien')->onDelete('cascade');
        $table->foreignId('dokter_id')->constrained('dokters', 'id_dokter')->onDelete('cascade');
        
        $table->date('tgl_kunjungan');
        
        // Data Medis (SOAP)
        $table->text('keluhan');       // Subjective
        $table->string('tensi')->nullable();    // Objective
        $table->integer('berat_badan')->nullable();
        $table->integer('suhu')->nullable();
        $table->text('diagnosa');      // Assessment
        $table->text('catatan_tambahan')->nullable(); // Plan
        
        $table->timestamps();
    });
}
};
