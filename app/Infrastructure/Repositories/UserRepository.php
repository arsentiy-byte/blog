<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Contracts\Repositories\UserRepositoryContract;
use App\Domain\Entities\User;
use App\Infrastructure\Models\User as UserModel;

final class UserRepository implements UserRepositoryContract
{
    public function save(User $user): void
    {
        /** @var UserModel $model */
        $model = UserModel::query()->firstOrNew([
            'id' => $user->getId(),
        ], [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ]);

        $model->save();
    }

    public function delete(User $user): void
    {
        /** @var UserModel $model */
        $model = UserModel::query()->findOrFail($user->getId());

        $model->delete();
    }

    public function findById(string $id): ?User
    {
        /** @var UserModel|null $model */
        $model = UserModel::query()->find($id);

        return $model?->entity();
    }

    public function findByEmail(string $email): ?User
    {
        /** @var UserModel|null $model */
        $model = UserModel::query()->where('email', $email)->first();

        return $model?->entity();
    }
}
