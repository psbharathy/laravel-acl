<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testCheckAdmin()
    {
        $this->visit('admin')
             ->seePageIs('/');
    }
}
