<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Services;

use App\Domain\Contracts\Services\AuthenticationServiceContract;
use App\Domain\ValueObjects\Authentication\LoginVO;
use App\Infrastructure\Exceptions\AuthenticationException;
use App\Infrastructure\Models\User;
use Tests\TestCase;

final class AuthenticationServiceTest extends TestCase
{
    private AuthenticationServiceContract $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(AuthenticationServiceContract::class);
    }

    public function testLogin(): void
    {
        $password = $this->faker->password;
        /** @var User $user */
        $user = User::factory()->create([
            'password' => $password,
        ]);

        $result = $this->service->login(new LoginVO($user->email, $password));

        $this->assertNotEmpty($result->token);
        $this->assertSame($user->name, $result->user->getName());
        $this->assertSame($user->email, $result->user->getEmail());
    }

    public function testUserNotExist(): void
    {
        $this->expectException(AuthenticationException::class);

        $this->service->login(new LoginVO($this->faker->email, $this->faker->password));
    }

    public function testInvalidCredentials(): void
    {
        $this->expectException(AuthenticationException::class);

        $password = $this->faker->password;
        /** @var User $user */
        $user = User::factory()->create([
            'password' => $password,
        ]);

        $this->service->login(new LoginVO($user->email, $this->faker->password));
    }
}
