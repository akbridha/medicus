<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreatePasienTest extends TestCase
{

    public $response;
    protected $data = [
        'NIK' => '12354355342',
        'NBL' => '02-02',
        'Nama' => 'ivory jeremy',
        'Tanggal_lahir' => '1990-01-01',
        'Umur' => '30',
        'Alamat' => 'Jl. Contoh No. 123',
        'Nomor_BPJS' => 'BPJS123456',
        'Jenis_Kelamin' => 'Laki-laki',
        'Pekerjaan' => 'Swasta',
    ];

    public function setUp(): void{
        parent::setUp();
        //eksekusi pengiriman data ke database
        $this->response = $this->post(route('pasien.store'), $this->data);
        // disimpan di setUp method agar
        // function lain tetap bisa akses dan data response tidak hilang

    }



    public function testCreatePasienReturnSuccessKey(): void
    {

        $this->response->assertSessionHas('key', 'Berhasil Menambah Pasien');
    }

    public function testDatabaseHasSameAttr(): void
    {
        $this->assertDatabaseHas('Pasiens', $this->data);
    }

    public function testRedirectKeIndexPage(): void
    {
        $this->response->assertRedirect(route('pasien.index'));
    }



}
