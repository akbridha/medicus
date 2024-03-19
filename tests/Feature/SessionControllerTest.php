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
    // use RefreshDatabase, WithFaker; // Memastikan database dikosongkan setelah setiap test


    public function testBelumLogin()
    {
        $this->assertFalse(Auth::check());
    }
    // public function testUserBisaLoginWithValidCredentials()
    // {
    //     // $user = User::factory()->create([
    //     //     'email' => 'test2@exa.com',
    //     //     'password' => 'password123',
    //     // ]);
    //     $response = $this->post('/sesi/login', [
    //         'email' => 'test2@exa.com',
    //         'password' => 'bebekbalap',
    //     ]);
    //     $response->assertRedirect('/sesi')->assertSessionHas('key', 'Berhasil');
    //     // $this->assertAuthenticatedAs($user);
    // }

    public function testUserFailLoginWithInvalidCredential(){
        $response = $this->post('/sesi/login', [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ]);
        $response->assertRedirect('/sesi')->assertSessionHasErrors();
    }

}
