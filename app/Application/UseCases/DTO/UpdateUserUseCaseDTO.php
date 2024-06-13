<?php

declare(strict_types=1);

namespace App\Application\UseCases\DTO;

final class UpdateUserUseCaseDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {
    }
}
