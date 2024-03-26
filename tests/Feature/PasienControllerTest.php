<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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

// <?php

// namespace Tests\Feature;

// use App\Models\Pasien;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;

// class PasienTest extends TestCase
// {
//     use RefreshDatabase, WithFaker;

//     /** @test */
//     public function user_can_search_pasien_by_nama()
//     {
//         $this->withoutExceptionHandling();

//         $pasien1 = Pasien::factory()->create(['Nama' => 'John Doe']);
//         $pasien2 = Pasien::factory()->create(['Nama' => 'Jane Doe']);

//         $response = $this->get('/pasien/find?kata_kunci=John');

//         $response->assertStatus(200)
//                 ->assertSee($pasien1->Nama)
//                 ->assertDontSee($pasien2->Nama);
//     }
// }

