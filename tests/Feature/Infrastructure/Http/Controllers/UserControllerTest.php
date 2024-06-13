<?php

declare(strict_types=1);

namespace Tests\Feature\Infrastructure\Http\Controllers;

use App\Infrastructure\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

final class UserControllerTest extends TestCase
{
    public function testCreate(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $password = $this->faker->password(8);

        $response = $this->post(route('api-users-create'), [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'message',
                'data',
            ]);
    }

    public function testUpdate(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $password = $this->faker->password(8);

        $response = $this->put(route('api-users-update', [
            'user' => $user->id,
        ]), [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'message',
                'data',
            ]);
    }

    public function testDelete(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $response = $this->delete(route('api-users-delete', [
            'user' => $user->id,
        ]));

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
