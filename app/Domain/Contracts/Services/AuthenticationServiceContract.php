<?php

declare(strict_types=1);

namespace App\Domain\Contracts\Services;

use App\Domain\ValueObjects\Authentication\LoginResultVO;
use App\Domain\ValueObjects\Authentication\LoginVO;

interface AuthenticationServiceContract
{
    public function login(LoginVO $vo): LoginResultVO;
}
