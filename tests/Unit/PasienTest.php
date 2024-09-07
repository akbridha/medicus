<?php

namespace Tests\Unit;

use App\Http\Controllers\PasienController;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Tests\TestCase;


class PasienTest extends TestCase
{
    /**
     * A basic unit test example.
     */


    // public function testTampilkanIndex(){

    // }

    public function testIndexPasien(): void
    {
        // akses url
        $response = $this->get('/pasien');
        // cek status
        $response->assertStatus(200);
        //cek konten yg ditampilkeun
        $response->assertSee('pasien');
    }

    public function testCariDataPasien(){
        //akses url
        $response = $this->get('/pasien/cari?kata_kunci=adam');
        // test status
        $response->assertStatus(200);
        //cek halaman
        $response->assertSee('pasien');

    }
}
