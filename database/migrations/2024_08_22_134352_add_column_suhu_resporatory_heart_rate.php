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
        Schema::table('rekam_medis', function (Blueprint $table) {
            $table->string('suhu')->nullable(); // Suhu tubuh dalam format desimal (misalnya 36.5)
            $table->string('respiratory')->nullable(); // Laju pernapasan (respiratory rate)
            $table->string('heart_rate')->nullable(); // Detak jantung (heart rate)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekam_medis', function (Blueprint $table) {
            $table->dropColumn('suhu');
            $table->dropColumn('respiratory');
            $table->dropColumn('heart_rate');
        });
    }
};
