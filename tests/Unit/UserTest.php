<?php

namespace Tests\Unit;


use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
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
