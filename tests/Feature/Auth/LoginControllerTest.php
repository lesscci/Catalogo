<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_SI_login()
    {
        // Crear usuario de prueba
        $user = User::factory()->create([
            'email' => 'ngomez.cep@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // Hacer una solicitud POST 
        $response = $this->post('/api/login', [
            'email' => 'ngomez.cep@gmail.com',
            'password' => 'password',
        ]);

        // Comprobar que la solicitud 200
        $response->assertStatus(200);

        // Comprobar que se devuelve un token de acceso
        $response->assertJsonStructure([
            'access_token',
            'token_type',
        ]);
    }

    public function test_user_NO_login()
    {
        $user = User::factory()->create([
            'email' => 'ngomez.cep@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // credenciales incorrectas
        $response = $this->post('/api/login', [
            'email' =>  'ngomez.cep@gmail.com',
            'password' => 'Password',
        ]);

        // Comprobar que la solicitud devuelve 401
        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Invalid login details',
        ]);
    }
}
