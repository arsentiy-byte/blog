<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Entities;

use App\Domain\Entities\User;
use App\Domain\ValueObjects\User\CreateVO;
use App\Domain\ValueObjects\User\UpdateVO;
use Tests\TestCase;

final class UserTest extends TestCase
{
    public function testUserCreatedSuccessfully(): void
    {
        $uuid = $this->faker->uuid;
        $vo = new CreateVO(
            $this->faker->name,
            $this->faker->email,
            $this->faker->password(8),
        );

        $user = User::create($uuid, $vo);

        $this->assertSame($uuid, $user->getId());
        $this->assertSame($vo->name, $user->getName());
        $this->assertSame($vo->email, $user->getEmail());
        $this->assertSame($vo->password, $user->getPassword());
    }

    public function testUserUpdatedSuccessfully(): void
    {
        $user = User::create(
            $this->faker->uuid,
            new CreateVO(
                $this->faker->name,
                $this->faker->email,
                $this->faker->password(8),
            )
        );

        $vo = new UpdateVO(
            $this->faker->name,
            $this->faker->email,
            $this->faker->password(8),
        );

        $user->update($vo);

        $this->assertSame($vo->name, $user->getName());
        $this->assertSame($vo->email, $user->getEmail());
        $this->assertSame($vo->password, $user->getPassword());
    }
}
