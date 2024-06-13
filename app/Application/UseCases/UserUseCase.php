<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Application\UseCases\DTO\CreateUserUseCaseDTO;
use App\Application\UseCases\DTO\UpdateUserUseCaseDTO;
use App\Domain\Contracts\Repositories\UserRepositoryContract;
use App\Domain\Entities\User;
use App\Domain\ValueObjects\User\CreateVO;
use App\Domain\ValueObjects\User\UpdateVO;

final readonly class UserUseCase
{
    public function __construct(
        private UserRepositoryContract $repository
    ) {
    }

    public function create(string $uuid, CreateUserUseCaseDTO $dto): void
    {
        $user = User::create(
            $uuid,
            new CreateVO(
                $dto->name,
                $dto->email,
                $dto->password,
            )
        );

        $this->repository->save($user);
    }

    public function update(User $user, UpdateUserUseCaseDTO $dto): void
    {
        $user
            ->update(new UpdateVO(
                $dto->name,
                $dto->email,
                $dto->password,
            ));

        $this->repository->save($user);
    }

    public function delete(User $user): void
    {
        $this->repository->delete($user);
    }
}
