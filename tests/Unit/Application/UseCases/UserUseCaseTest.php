<?php

declare(strict_types=1);

namespace Tests\Unit\Application\UseCases;

use App\Application\UseCases\DTO\CreateUserUseCaseDTO;
use App\Application\UseCases\DTO\UpdateUserUseCaseDTO;
use App\Application\UseCases\UserUseCase;
use App\Domain\Contracts\Repositories\UserRepositoryContract;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

final class UserUseCaseTest extends TestCase
{
    private UserRepositoryContract $repository;

    private UserUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->app->make(UserRepositoryContract::class);
        $this->useCase = $this->app->make(UserUseCase::class);
    }

    public function testUserCreated(): void
    {
        $uuid = $this->faker->uuid;
        $dto = new CreateUserUseCaseDTO(
            $this->faker->name,
            $this->faker->email,
            $this->faker->password,
        );

        $this->useCase->create($uuid, $dto);

        $user = $this->repository->findById($uuid);

        $this->assertSame($uuid, $user->getId());
        $this->assertSame($dto->name, $user->getName());
        $this->assertSame($dto->email, $user->getEmail());
        $this->assertTrue(Hash::check($dto->password, $user->getPassword()));
    }

    public function testUserUpdated(): void
    {
        $uuid = $this->faker->uuid;
        $this->useCase
            ->create(
                $uuid,
                new CreateUserUseCaseDTO(
                    $this->faker->name,
                    $this->faker->email,
                    $this->faker->password,
                )
            );

        $user = $this->repository->findById($uuid);

        $dto = new UpdateUserUseCaseDTO(
            $this->faker->name,
            $this->faker->email,
            $this->faker->password,
        );

        $this->useCase->update($user, $dto);

        $this->assertSame($uuid, $user->getId());
        $this->assertSame($dto->name, $user->getName());
        $this->assertSame($dto->email, $user->getEmail());
        $this->assertSame($dto->password, $user->getPassword());
    }

    public function testUserDeleted(): void
    {
        $uuid = $this->faker->uuid;
        $this->useCase
            ->create(
                $uuid,
                new CreateUserUseCaseDTO(
                    $this->faker->name,
                    $this->faker->email,
                    $this->faker->password,
                )
            );

        $user = $this->repository->findById($uuid);

        $this->useCase->delete($user);

        $this->assertTrue(true);
    }
}
