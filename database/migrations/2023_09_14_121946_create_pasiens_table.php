<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('NIK', 16)->unique(); // Varchar dengan panjang 16 karakter, unik.
            $table->string('NBL');
            $table->string('Nama');
            $table->date('Tanggal_lahir')->nullable();
            $table->string('Umur')->nullable();
            $table->string('Alamat');
            $table->string('Nomor_BPJS')->nullable();
            $table->string('Jenis_Kelamin');
            $table->string('Pekerjaan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
