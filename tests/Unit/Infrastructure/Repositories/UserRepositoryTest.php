<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Repositories;

use App\Domain\Contracts\Repositories\UserRepositoryContract;
use App\Domain\Entities\User;
use Tests\TestCase;

final class UserRepositoryTest extends TestCase
{
    private UserRepositoryContract $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->app->make(UserRepositoryContract::class);
    }

    public function testSave(): void
    {
        $user = new User(
            $this->faker->uuid,
            $this->faker->name,
            $this->faker->email,
            $this->faker->password,
        );

        $this->repository->save($user);

        $this->assertDatabaseHas('users', [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ]);
    }

    public function testDelete(): void
    {
        $user = new User(
            $this->faker->uuid,
            $this->faker->name,
            $this->faker->email,
            $this->faker->password,
        );

        $this->repository->save($user);

        $this->repository->delete($user);

        $this->assertDatabaseMissing('users', [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ]);
    }

    public function testFindById(): void
    {
        $user = new User(
            $this->faker->uuid,
            $this->faker->name,
            $this->faker->email,
            $this->faker->password,
        );

        $this->repository->save($user);

        $foundUser = $this->repository->findById($user->getId());

        $this->assertSame($user->getId(), $foundUser->getId());
        $this->assertSame($user->getName(), $foundUser->getName());
        $this->assertSame($user->getEmail(), $foundUser->getEmail());
    }

    public function testFindByEmail(): void
    {
        $user = new User(
            $this->faker->uuid,
            $this->faker->name,
            $this->faker->email,
            $this->faker->password,
        );

        $this->repository->save($user);

        $foundUser = $this->repository->findByEmail($user->getEmail());

        $this->assertSame($user->getId(), $foundUser->getId());
        $this->assertSame($user->getName(), $foundUser->getName());
        $this->assertSame($user->getEmail(), $foundUser->getEmail());
    }
}
