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
    Schema::create('rekam_medis_obat', function (Blueprint $table) {
        $table->id();
        // Foreign Keys
        $table->foreignId('rekam_medis_id')->constrained('rekam_medis', 'id_rm')->onDelete('cascade');
        $table->foreignId('obat_id')->constrained('obats', 'id_obat')->onDelete('cascade');
        
        // Kolom Tambahan (Pivot Data)
        $table->integer('jumlah');
        $table->string('aturan_pakai');
        
        $table->timestamps();
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
