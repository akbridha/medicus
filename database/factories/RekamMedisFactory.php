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

            'pasien_id' => $faker->numberBetween(1, 80),
            'tanggal' => $faker->date,
            'keluhan' =>  $faker->sentence($nbWords = 6, $variableNbWords = true, $theme = 'health'),
            'tekanan_darah'=> $faker->numberBetween(90, 180) . '/' . $faker->numberBetween(60, 120),
            'berat_badan' => $faker->numberBetween(40, 150),
            'tinggi_badan' => $faker->numberBetween(120, 220),
            'pemeriksaan' => $faker->sentence($nbWords = 16, $variableNbWords = true, $theme = 'health'),
            'diagnosa' => $faker->paragraph(3), // Membuat 3 paragraf tentang diagnosis
        ];
    }
}
