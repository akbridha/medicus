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

        $keluhan = [
            "sudah beberapa hari ini merasa sakit kepala terus-menerus.",
            "Perut  terasa nyeri dan mual, apalagi setelah makan.",
            " sering merasa lemas dan mudah capek, padahal tidak banyak aktivitas.",
            "Tenggorokan  sakit sekali, susah untuk menelan.",
            "Dada  terasa sesak dan nyeri saat bernapas.",
            " sudah seminggu ini demam naik turun dan menggigil.",
            "Sendi-sendi  terasa nyeri dan kaku, terutama di pagi hari.",
            " merasa pusing dan mata berkunang-kunang setiap kali berdiri.",
            "Batuk tidak kunjung sembuh, bahkan disertai dahak berdarah.",
            "Kulit  gatal-gatal dan muncul ruam merah di beberapa bagian tubuh.",
            "sering merasa jantung berdebar-debar, terutama saat istirahat.",
            "Kaki  bengkak dan terasa nyeri ketika berjalan.",
            " mengalami diare terus-menerus selama beberapa hari ini.",
            "Telinga  terasa berdengung dan pendengaran  berkurang.",
            " merasa sering buang air kecil dan terasa nyeri saat buang air.",
            "Mata terasa perih dan sensitif terhadap cahaya.",
            "Leher kaku dan sakit saat digerakkan.",
            "sering merasa mual di pagi hari, tapi tidak ada nafsu makan.",
            "Bahu dan punggung terasa kaku dan pegal, terutama setelah bangun tidur.",
            "mengalami pendarahan meskipun haid belum waktunya."];
        return [

            'pasien_id' => $faker->numberBetween(1, 50),
            'tanggal' => $faker->date,
            'tekanan_darah'=> $faker->numberBetween(90, 120) . '/' . $faker->numberBetween(60, 80),
            'berat_badan' => $faker->numberBetween(40, 150),
            'tinggi_badan' => $faker->numberBetween(120, 190),
            'pemeriksaan' => 'belum diperiksa',
            'keluhan' => $keluhan[array_rand($keluhan)],

            'diagnosa' => $faker->paragraph(3), // Membuat 3 paragraf tentang diagnosis
            'suhu' => $faker->numberBetween(40, 150),
            'respiratory' => $faker->numberBetween(16, 24),
            'heart_rate' => $faker->numberBetween(16, 80),
        ];
    }
}
