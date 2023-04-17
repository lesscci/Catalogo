<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class InfUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_show()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->getJson('/api/user');

        $response->assertOk();
        $response->assertJsonStructure([
            'name',
            'email',
        ]);
    }

    public function test_update()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $newName = 'Manuel Gomez';
        $newEmail = 'manuelg@gmail.com';
        $newPassword = 'manuel123';

        $response = $this->putJson('/api/user', [
            'name' => $newName,
            'email' => $newEmail,
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ]);

        $response->assertOk();
        $response->assertJson([
            'message' => 'User updated successfully',
        ]);

        // Check that user info has been updated in the database
        $user->refresh();

        $this->assertEquals($newName, $user->name);
        $this->assertEquals($newEmail, $user->email);
        $this->assertTrue(Hash::check($newPassword, $user->password));
    }
}
