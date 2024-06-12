<?php

declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Domain\Contracts\Services\AuthenticationServiceContract;
use App\Domain\ValueObjects\Authentication\LoginResultVO;
use App\Domain\ValueObjects\Authentication\LoginVO;
use App\Infrastructure\Exceptions\AuthenticationException;
use App\Infrastructure\Models\User;
use App\Infrastructure\Traits\ConfigTrait;
use Illuminate\Support\Facades\Hash;

final readonly class AuthenticationService implements AuthenticationServiceContract
{
    use ConfigTrait;

    /**
     * @throws AuthenticationException
     */
    public function login(LoginVO $vo): LoginResultVO
    {
        /** @var User|null $user */
        $user = User::query()->where('email', $vo->email)->first();

        if (null === $user) {
            throw AuthenticationException::userNotExist();
        }

        if ( ! Hash::check($vo->password, $user->password)) {
            throw AuthenticationException::invalidCredentials();
        }

        return new LoginResultVO(
            $user->createToken($this->getPersonalAccessTokenName())->accessToken,
            $user->entity(),
        );
    }
}
