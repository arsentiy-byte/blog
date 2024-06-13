<?php

declare(strict_types=1);

namespace Tests\Unit\Application\UseCases;

use App\Application\UseCases\AuthenticationUseCase;
use App\Application\UseCases\DTO\LoginUserUseCaseDTO;
use App\Infrastructure\Models\User;
use Tests\TestCase;

final class AuthenticationUseCaseTest extends TestCase
{
    private AuthenticationUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = $this->app->make(AuthenticationUseCase::class);
    }

    public function testLogin(): void
    {
        $password = $this->faker->password;
        /** @var User $user */
        $user = User::factory()->create([
            'password' => $password,
        ]);

        $result = $this->useCase->login(new LoginUserUseCaseDTO($user->email, $password));

        $this->assertNotEmpty($result->token);
        $this->assertSame($user->id, $result->user->getId());
        $this->assertSame($user->name, $result->user->getName());
        $this->assertSame($user->email, $result->user->getEmail());
    }
}
