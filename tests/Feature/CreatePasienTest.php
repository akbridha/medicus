<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreatePasienTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public $data = [
            'NIK' => '423456789',
            'NBL' => '20-02',
            'Nama' => 'John Doe',
            'Tanggal_lahir' => '1990-01-01',
            'Umur' => '30',
            'Alamat' => 'Jl. Contoh No. 123',
            'Nomor_BPJS' => 'BPJS123456',
            'Jenis_Kelamin' => 'Laki-laki',
            'Pekerjaan' => 'Swasta',
        ];
    public function test_akses_form(): void
    {
        $response = $this->get(route('pasien.index'));


        $response->assertStatus(200);
    }
    public function test_create_pasien():void
    {

        $data = $this->data;
        $response = $this->post(route('pasien.store'), $data);

    }

    public function test_data_tersimpan(){
        $data = $this->data;
        $this->assertDatabaseHas('pasiens', $data);
}
}
