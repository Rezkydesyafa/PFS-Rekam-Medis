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
        Schema::create('rekam_medis_tindakan', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('rekam_medis_id')
                  ->constrained('rekam_medis', 'id_rm')
                  ->onDelete('cascade');
                  
            $table->foreignId('tindakan_medis_id')
                  ->constrained('tindakan_medis', 'id_tindakan')
                  ->onDelete('cascade');
                  
            $table->decimal('harga', 15, 2); // Snapshot harga saat tindakan dilakukan
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis_tindakan');
    }
};
