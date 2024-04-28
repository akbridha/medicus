<?php

namespace Tests\Feature;

use Tests\TestCase;

class LandingTest extends TestCase
{
    private $response;


    protected function setUp(): void
    {
        parent::setUp();

        $this->response = $this->get('/');
    }
    public function test_landing_di_dashboard(): void
    {

        $this->response->assertStatus(200);///
    }
    public function test_view_is_welcomedotphp():void{

        $this->response->assertViewIs('layouts.welcome');
    }
}
