<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use DatabaseTransactions;

class PasienControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */



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



