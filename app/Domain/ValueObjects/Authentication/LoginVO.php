<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects\Authentication;

final class LoginVO
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }
}
