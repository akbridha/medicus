<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase; // Use the TestCase class from Tests namespace

class dashboardTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
                // Check that the application is in the testing environment
                $this->assertEquals('testing', app()->environment());

                // Check that the database connection is SQLite
                $this->assertEquals('sqlite', config('database.default'));

                // Check that the database is in-memory (optional)
                $this->assertEquals(':memory:', config('database.connections.sqlite.database'));

                $this->assertTrue(true);
    }


}
