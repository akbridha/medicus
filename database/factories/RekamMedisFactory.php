<?php

namespace Database\Factories;

use App\Models\RekamMedis;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class RekamMedisFactory extends Factory
{
    protected $model = RekamMedis::class;

    public function definition()
    {
        $faker = \Faker\Factory::create('id_ID'); // Ganti 'id_ID' dengan locale yang sesuai

        return [

            'pasien_id' => $faker->numberBetween(1, 100),
            'tanggal' => $faker->date,
            'pemeriksaan' => $faker->sentence,
            'diagnosa' => $faker->paragraph(3), // Membuat 3 paragraf tentang diagnosis
        ];
    }
}
