<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testUserSIRegistro()
    {
        $response = $this->post('/api/register', [
            'name' => 'Natalie',
            'email' => 'ngomez.cep@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
        ]);
    }
    public function testRegistroFaltaAlgo()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Natalie',
            'email' => '',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }

    public function testRegistroInvalido()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Natalie',
            'email' => 'invalid_email',
            'password' => 'password',
            'password_confirmation' => 'password2'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['password']);
    }
}
