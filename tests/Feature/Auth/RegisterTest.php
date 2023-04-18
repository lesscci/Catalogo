<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_SI_register()
    {
        // Hacer una solicitud POST al endpoint de registro con credenciales válidas
        $response = $this->post('/api/register', [
            'name' => 'Natalie',
            'email' => 'ngomez.cep@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        // Comprobar que la solicitud fue exitosa
        $response->assertStatus(200);

        // Comprobar que se devuelve un token de acceso
        $response->assertJsonStructure([
            'access_token',
            'token_type',
        ]);
    }
    public function test_register_missing()
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

    public function test_register_invalid()
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
