<?php

declare(strict_types=1);

namespace App\Domain\Contracts\Repositories;

use App\Domain\Entities\User;

interface UserRepositoryContract
{
    public function save(User $user): void;

    public function delete(User $user): void;

    public function findById(string $id): ?User;

    public function findByEmail(string $email): ?User;
}
