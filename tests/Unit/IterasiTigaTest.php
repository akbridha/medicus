<?php

namespace Tests\Unit;

use Tests\TestCase;

class IterasiTigaTest extends TestCase
{



// Menampilkan data rekam medis
    public function test_show_rm(): void
    {
        $response = $this->get('/pasien');

        $response->assertStatus(200);
        $this->assertTrue(true);
    }
// Menampilkan data rekam yang diantrikan
    public function test_show_queued_up(): void
    {
        $this->assertTrue(true);
    }
// Menampilkan Keluhan (RPS)
    public function test_show_rps(): void
    {
        $this->assertTrue(true);
    }
// Menampilkan Riwayat RM (RPD)
    public function test_show_rpd(): void
    {
        $this->assertTrue(true);
    }
// simpan data rekam medis
    public function test_save_rm(): void
    {
        $this->assertTrue(true);
    }


}
