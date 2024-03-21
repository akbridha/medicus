<?php
// namespace Tests\Feature;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;
// class SessionControllerTest extends TestCase
// {
//     /**
//      * A basic feature test example.
//      */
//     public function test_example(): void
//     {
//         $response = $this->get('/');

//         $response->assertStatus(200);
//     }
// }



use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SessionControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // Pastikan user tidak login sebelum setiap test
        $this->assertFalse(Auth::check());
    }

    public function testBelumLogin()
    {
        // Pastikan user belum login
        $this->assertFalse(Auth::check());
    }

    public function testProsesLogin()
    {

        // Lakukan proses login
        $response = $this->prosesLogin();
        // Cek bahwa user sudah login
        $response->assertRedirect('/sesi')->assertSessionHas('key', 'Berhasil');

    }

    public function testSudahLogin()
    {
        // Lakukan proses login
        $this->prosesLogin();
        // Pastikan user sudah login
        $this->assertTrue(Auth::check());
    }

    private function prosesLogin()
    {
        // Lakukan proses login sesuai dengan implementasi Anda
        $response = $this->post('/sesi/login', [
            'email' => 'test2@exa.com',
            'password' => 'bebekbalap',
        ]);
        return $response;
    }

}
