<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase; // Membersihkan database sebelum setiap test

    /** @test */
    public function test_it_can_get_total_pasien()
    {
        // Buat 5 pasien di database testing
        Pasien::factory()->count(5)->create();

        // Akses halaman home
        $response = $this->get('/');

        // Pastikan jumlah pasien yang dikirim ke view benar
        $response->assertViewHas('jumlahPasien', 5);
    }

    /** @test */
    public function test_it_can_get_pasien_bulan_ini()
    {
        // Set tanggal ke Februari 2024
        Carbon::setTestNow(Carbon::create(2024, 2, 1));

        // Buat pasien bulan ini
        Pasien::factory()->count(3)->create(['created_at' => now()]);

        // Buat pasien bulan sebelumnya
        Pasien::factory()->count(2)->create(['created_at' => now()->subMonth()]);

        $response = $this->get('/');

        // Pastikan hanya pasien bulan ini yang dihitung
        $response->assertViewHas('jumlahPasienBulanIni', 3);

        Carbon::setTestNow(); // Reset waktu setelah test
    }
}
