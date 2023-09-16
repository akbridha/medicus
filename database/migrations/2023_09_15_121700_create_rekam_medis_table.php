<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->integer('pasien_id');
            $table->date('tanggal');
            $table->string('pemeriksaan');
            $table->text('diagnosa');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
