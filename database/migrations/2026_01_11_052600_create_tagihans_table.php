<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id('id_tagihan');
            
            // Relasi ke Rekam Medis (One-to-One)
            // 'id_rm' adalah nama kolom primary key di tabel rekam_medis
            $table->foreignId('rekam_medis_id')
                  ->constrained('rekam_medis', 'id_rm')
                  ->onDelete('cascade');
            
            // Rincian Biaya (Format Decimal untuk Uang)
            $table->decimal('biaya_dokter', 15, 2); // Tarif dokter saat itu
            $table->decimal('biaya_obat', 15, 2);   // Total harga obat saat itu
            $table->decimal('biaya_tindakan', 15, 2)->default(0); // Opsional jika ada tindakan tambahan
            $table->decimal('total_bayar', 15, 2);  // Grand Total
            
            // Status & Info Pembayaran
            $table->enum('status', ['Belum Lunas', 'Lunas'])->default('Belum Lunas');
            $table->string('metode_pembayaran')->nullable(); // Cash, Transfer, QRIS (Diisi saat bayar)
            $table->dateTime('waktu_pembayaran')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};