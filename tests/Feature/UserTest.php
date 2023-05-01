<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testLogin()
    {
        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => 'Asd,car21'
        ]);

        $response->assertStatus(302);
    }
}
