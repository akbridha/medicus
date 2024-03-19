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
        $response = $this->get('/pasien');

        $response->assertStatus(200);
    }

    public function testCariDataPasien(){
        $response = $this->get('cari?kata_kunci=adam');
        $response->assertStatus(200);

    }
}
