<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RekamMedisTest extends TestCase
{


    public $response;
    protected $data = [

                'pasien_id' => '5',
                'pemeriksaan' => 'belum diperiksa',//dari view dikirimkan value 'belum diperiksa'
                'berat_badan' => '68',
                'tinggi_badan' => '162',
                'tekanan_darah' => '144',
                'keluhan' =>'keluhan',

    ];

    public function setUp(): void{
        parent::setUp();
        //eksekusi pengiriman data ke database
        $this->response = $this->post(route('rm.regis'), $this->data);
        // disimpan di setUp method agar
        // function lain tetap bisa akses dan data response tidak hilang

    }



    public function testCreateRmReturnSuccessKey(): void
    {

        $this->response->assertSessionHas('key', 'Berhasil Registrasi Pasien');
    }

    public function testDatabaseHasSameAttr(): void
    {
        $this->assertDatabaseHas('rekam_medis', $this->data);
    }

    public function testRedirectKeIndexPage(): void
    {
        $this->response->assertRedirect('/');
    }


}
