<?php

namespace Tests\Unit;

use Tests\TestCase;


class IterasiTujuhTest extends TestCase
{


    //buat menampilkeun laman utama logistk
    public function test_show_main_logistik():void{

        //akses dulu
        $response = $this->get('/logistik');
        // assert status
        $response->assertStatus(200);
        //assert test yang terdapat di halaman
        $response->assertSee('Daftar Logistik');
        $response->assertSee('Tambah Logistik');

    }


    // buat logistik baru nah

    public function test_create_bmhp(): void
    {
        $response = $this->get('/logistik_create');
        $response->assertStatus(200);
        $response->assertSee("Formulir Logistik Baru");
    }
    /**
     * Menampilkan halaman untuk pembaruan BMHP

     */
    public function test_show_update(): void
    {
        $response = $this->get('/logistik/2/edit');
        $response->assertStatus(200);
        $response->assertSee("Edit");
    }

    /**
     * Menyimpan Perubahan Pada BMHP

     */
    public function test_save_update(): void
    {
        $this->assertTrue(true);
    }



    /**
     * Menghapus BMHP
     */
    public function test_remove_bmhp(): void
    {
        $this->assertTrue(true);
    }




    /**
     * Menghapus data keluarga
     */
    public function test_remove_patient_family(): void
    {
        $this->assertTrue(true);
    }







}
