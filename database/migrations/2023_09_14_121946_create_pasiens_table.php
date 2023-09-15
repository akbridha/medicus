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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('NIK', 16)->unique(); // Varchar dengan panjang 16 karakter, unik.
            $table->string('NBL');
            $table->string('Nama');
            $table->date('Tanggal_lahir');
            $table->string('Umur');
            $table->string('Alamat');
            $table->string('Nomor_BPJS');
            $table->string('Jenis_Kelamin');
            $table->string('Pekerjaan');
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
