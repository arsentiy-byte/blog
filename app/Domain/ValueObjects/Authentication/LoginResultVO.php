<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects\Authentication;

use App\Domain\Entities\User;

final class LoginResultVO
{
    public function __construct(
        public string $token,
        public User $user,
    ) {
    }
}
