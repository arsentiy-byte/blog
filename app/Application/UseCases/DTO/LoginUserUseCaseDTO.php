<?php

declare(strict_types=1);

namespace App\Application\UseCases\DTO;

final class LoginUserUseCaseDTO
{
    public function __construct(
        public string $email,
        public string $password
    ) {
    }
}
