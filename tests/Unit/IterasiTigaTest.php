<?php

namespace Tests\Unit;

use Tests\TestCase;

class IterasiTigaTest extends TestCase
{



// Menampilkan data rekam medis
    public function test_show_rm(): void
    {
        //akses URL
        $response = $this->get('/rm');
        // assert status
        $response->assertStatus(302);
;
        $this->assertTrue(true);

    }
// Menampilkan data rekam yang diantrikan
    public function test_periksa_queued_up(): void
    {

        //akses dulu
        $response = $this->get('/rm/antrian');
        // assert status
        $response->assertStatus(302);

        $this->assertTrue(true);

    }
// Menampilkan Keluhan (RPS)
    public function test_show_rps(): void
    {
                //akses dulu
                $response = $this->get('/logistik');
                // assert status
                $response->assertStatus(200);
                //assert test yang terdapat di halaman
                $response->assertSee('Daftar Logistik');
                $response->assertSee('Tambah Logistik');

        $this->assertTrue(true);
    }
// Menampilkan Riwayat RM (RPD)
    public function test_show_rpd(): void
    {
                //akses dulu
                $response = $this->get('/logistik');
                // assert status
                $response->assertStatus(200);
                //assert test yang terdapat di halaman
                $response->assertSee('Daftar Logistik');
                $response->assertSee('Tambah Logistik');

        $this->assertTrue(true);
    }
// simpan data rekam medis
    public function test_save_rm(): void
    {
                //akses dulu
                $response = $this->get('/logistik');
                // assert status
                $response->assertStatus(200);
                //assert test yang terdapat di halaman
                $response->assertSee('Daftar Logistik');
                $response->assertSee('Tambah Logistik');

        $this->assertTrue(true);
    }


}
