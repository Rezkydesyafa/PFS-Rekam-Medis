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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('pasiens');
        Schema::enableForeignKeyConstraints();

        Schema::create('pasiens', function (Blueprint $table) {
            $table->id('id_pasien'); // Primary Key sesuai skema lama
            $table->string('name');
            $table->string('nik', 16)->unique();
            $table->string('no_rm', 20)->unique();
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('gol_darah', 5)->nullable();
            $table->string('status_nikah', 20)->nullable();
            $table->string('no_hp', 20);
            $table->string('email')->nullable();
            $table->text('alamat');
            $table->string('status')->default('active'); // active, inactive, pending
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
