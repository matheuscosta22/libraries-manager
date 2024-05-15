<?php

namespace Tests\Feature;

use App\Domains\User\Models\User;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testCreateUser(): void
    {
        $response = $this->withHeader('Accept', 'application/json')
            ->post('/api/users', [
                'name' => 'testing',
                'email' => $email = 'test@gmail.com',
                'password' => $password = 123456
            ]);

        $response->assertSuccessful();

        $response = $this->withHeader('Accept', 'application/json')
            ->post('/api/login', ['email' => $email, 'password' => $password]);

        $response->assertSuccessful();
    }

    public function testLoginSuccessful(): void
    {
        $user = User::factory()->create(['password' => $password = 12345]);
        $response = $this->withHeader('Accept', 'application/json')
            ->post('/api/login', ['email' => $user->email, 'password' => $password]);

        $response->assertSuccessful();
    }

    public function testLoginFailed(): void
    {
        $user = User::factory()->create(['password' => $password = 12345]);
        $response = $this->withHeader('Accept', 'application/json')
            ->post('/api/login', ['email' => $user->email, 'password' => $password . 1]);

        $response->assertUnauthorized();
    }

    public function testLogout(): void
    {
        $user = User::factory()->create(['password' => $password = 12345]);
        $response = $this->withHeader('Accept', 'application/json')
            ->post('/api/login', ['email' => $user->email, 'password' => $password]);

        $response->assertSuccessful();

        $response = $this->withHeader('Accept', 'application/json')
            ->withHeader('Authorization', 'Bearer ' . $response->json('token'))
            ->delete('/api/logout');

        $response->assertSuccessful();
    }
}
