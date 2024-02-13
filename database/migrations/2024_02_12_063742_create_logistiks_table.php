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
        Schema::create('logistiks', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Field "nama" sebagai string
            $table->string('jenis');
            $table->string('kadaluarsa');
            $table->integer('jumlah'); // Field "jumlah" sebagai integer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logistiks');
    }
};
