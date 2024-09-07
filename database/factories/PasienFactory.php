<?php

namespace Database\Factories;

use App\Models\Pasien;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pasien>
 */
class PasienFactory extends Factory
{
    protected $model = Pasien::class;
    private static $lastNomorUrut = 0; // Inisialisasi variabel di luar fungsi definition


    public function definition()
    {
        $faker = \Faker\Factory::create('id_ID'); // Gunakan locale 'id_ID' untuk data dalam bahasa Indonesia
        self::$lastNomorUrut++;
        $formattedNomor = str_pad(self::$lastNomorUrut, 4, '0', STR_PAD_LEFT);
        $formattedNomor = substr_replace($formattedNomor, "-", 2, 0);
        // $formattedNomor = substr($formattedNomor, 0, 2) . '-' . substr($formattedNomor, 2);
      return [
          'NIK' => $faker->numerify('################'), // 16 digit angka
            'NBL' => $formattedNomor,
            'Nama' => $faker->name,
            'Tanggal_lahir' => $faker->date,
            // 'Umur' => $faker->randomNumber(2),
            'Alamat' => $faker->address,
            // 'Nomor_BPJS' => $faker->numerify('BPJS########'), // BPJS dengan 9 angka acak
            'Jenis_Kelamin' => $faker->randomElement(['male', 'female']),
            'Pekerjaan' => $faker->jobTitle,
        ];
    }
}
