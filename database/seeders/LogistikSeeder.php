<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LogistikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('logistiks')->insert([
            [
                'nama' => 'Paracetamol (Acetaminophen)',
                'jenis' => 'Analgesik',
                'jumlah' => 100,
                'kadaluarsa' => '2025-12-31',
            ],
            [
                'nama' => 'Ibuprofen',
                'jenis' => 'NSAID (Non-Steroidal Anti-Inflammatory Drug)',
                'jumlah' => 200,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Amoxicillin',
                'jenis' => 'Antibiotik ',
                'jumlah' => 50,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Cetirizine',
                'jenis' => 'Antihistamin',
                'jumlah' => 90,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Loperamide',
                'jenis' => 'Antidiare',
                'jumlah' => 30,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Amlodipine',
                'jenis' => 'Penghambat kalsium (antihipertensi)',
                'jumlah' => 80,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Metformin',
                'jenis' => 'Antidiabetes',
                'jumlah' => 70,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Simvastatin',
                'jenis' => 'Statin (penurun kolesterol)',
                'jumlah' => 50,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Salbutamol',
                'jenis' => 'Bronkodilator',
                'jumlah' => 70,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Omeprazole',
                'jenis' => ' Inhibitor pompa proton (Proton Pump Inhibitor/PPI)',
                'jumlah' => 40,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Dexamethasone',
                'jenis' => 'Kortikosteroid',
                'jumlah' => 20,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Diazepam',
                'jenis' => 'Benzodiazepin',
                'jumlah' => 90,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Ranitidine',
                'jenis' => 'Antagonis reseptor H2',
                'jumlah' => 60,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Ciprofloxacin',
                'jenis' => 'Antibiotik (golongan fluoroquinolon)',
                'jumlah' => 30,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Hydrochlorothiazide (HCT)',
                'jenis' => 'Diuretik (penghambat reabsorpsi natrium)',
                'jumlah' => 50,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Warfarin',
                'jenis' => 'Antikoagulan',
                'jumlah' => 60,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Clopidogrel',
                'jenis' => 'Antiplatelet',
                'jumlah' => 10,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Furosemide',
                'jenis' => 'Antagonis',
                'jumlah' => 90,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Ranitidine',
                'jenis' => 'Diuretik (loop diuretik)',
                'jumlah' => 80,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Metronidazole',
                'jenis' => 'Antibiotik dan antiprotozoa',
                'jumlah' => 20,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Aspirin (Acetylsalicylic Acid)',
                'jenis' => 'Antiplatelet, analgesik, antipiretik',
                'jumlah' => 90,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Glibenclamide (Glyburide)',
                'jenis' => 'Sulfonilurea (antidiabetes)',
                'jumlah' => 80,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Ranitidine',
                'jenis' => 'Antagonis',
                'jumlah' => 30,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => ' Loratadine',
                'jenis' => 'Antihistamin (non-sedatif)',
                'jumlah' => 60,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Prednisone',
                'jenis' => 'Kortikosteroid',
                'jumlah' => 70,
                'kadaluarsa' => '2024-11-30',
            ],
            [
                'nama' => 'Captopril',
                'jenis' => 'ACE inhibitor (Antihipertensi)',
                'jumlah' => 40,
                'kadaluarsa' => '2024-11-30',
            ],
            // Tambahkan lebih banyak data sesuai kebutuhan
        ]);
    }
}
