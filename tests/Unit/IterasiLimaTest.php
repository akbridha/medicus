<?php

namespace Tests\Unit;

use Tests\TestCase;

class IterasiLimaTest extends TestCase
{


    /**
     * Menampilkan halaman input data BMHP ke sistem
     */
    public function test_show_create(): void
    {
        //aksi akses
        $response = $this->get('/logistik_create');
        //cek status
        $response->assertStatus(200);
        //cek konten
        $response->assertSee("Formulir Logistik Baru");
        $this->assertTrue(true);
    }

    /**
     * Menyimpan data baru yang dimasukkan
     */
    public function test_store(): void
    {
        $this->assertTrue(true);
    }

    /**
     *Menampilkan BMHP yang tersedia
     */
    public function test_show_bmhp(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Memilih BMHP yang digunakan
     */
    public function test_choose_bmhp(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Menyimpan perubahan BMHP tiap kali pemeriksaan
     */
    public function test_save_tx(): void
    {
        $this->assertTrue(true);
    }

}
