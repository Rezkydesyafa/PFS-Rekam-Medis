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
        Schema::table('dokters', function (Blueprint $table) {
            // Kita tambahkan kolom tarif (format uang) setelah kolom spesialisasi
            // Kita kasih default(0) supaya data dokter lama tidak error (otomatis diisi 0 dulu)
            $table->decimal('tarif', 12, 2)->default(0)->after('spesialisasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokters', function (Blueprint $table) {
            // Ini jaga-jaga kalau mau undo perubahan
            $table->dropColumn('tarif');
        });
    }
};