<?php

declare(strict_types=1);

namespace Tests\Feature\Infrastructure\Http\Controllers;

use App\Infrastructure\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

final class AuthenticationControllerTest extends TestCase
{
    public function testLogin(): void
    {
        $password = $this->faker->password(8);
        /** @var User $user */
        $user = User::factory()->create([
            'password' => $password,
        ]);

        $response = $this->post(route('api-auth-login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'token',
                    'user',
                ],
            ]);
    }
}
