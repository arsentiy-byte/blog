<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects\User;

final class CreateVO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {
    }
}
