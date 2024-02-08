<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');
        // dd("func called")      ;

        $response->assertStatus(200);
    }

    public function testAksesUrlUser(){

        $respon = $this->get(route('user.index'));
        $respon -> assertStatus(200);
    }


}
