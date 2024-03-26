<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Test User',
            'email' => 'tesxt2@exa.com',
            'password' => 'veve',  //entah kenapa selalu dihash dan generate otomatis oleh laravel
        ]);
    }
}
