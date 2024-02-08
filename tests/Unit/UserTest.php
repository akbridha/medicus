<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function testLoginOk(){

        $user = new UserController;
        $this->assertTrue($user->index());
    }
}
