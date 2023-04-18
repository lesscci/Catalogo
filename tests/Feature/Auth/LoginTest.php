<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function testUserSILogin()
    {

        $user = User::factory()->create([
            'email' => 'ngomez.cep@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/api/login', [
            'email' => 'ngomez.cep@gmail.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
        ]);
    }

    public function testUserNOLogin()
    {
        $user = User::factory()->create([
            'email' => 'ngomez.cep@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // incorrectas
        $response = $this->post('/api/login', [
            'email' =>  'ngomez.cep@gmail.com',
            'password' => 'Password',
        ]);

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Invalid login details',
        ]);
    }
}
