<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Application\UseCases\DTO\LoginUserUseCaseDTO;
use App\Domain\Contracts\Services\AuthenticationServiceContract;
use App\Domain\ValueObjects\Authentication\LoginResultVO;
use App\Domain\ValueObjects\Authentication\LoginVO;

final readonly class AuthenticationUseCase
{
    public function __construct(
        private AuthenticationServiceContract $service
    ) {
    }

    public function login(LoginUserUseCaseDTO $dto): LoginResultVO
    {
        return $this->service->login(new LoginVO($dto->email, $dto->password));
    }
}
