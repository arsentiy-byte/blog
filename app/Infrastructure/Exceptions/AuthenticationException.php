<?php

declare(strict_types=1);

namespace App\Infrastructure\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

final class AuthenticationException extends Exception
{
    public static function invalidCredentials(): self
    {
        return new self('Invalid credentials', Response::HTTP_BAD_REQUEST);
    }

    public static function userNotExist(): self
    {
        return new self('User does not exist', Response::HTTP_NOT_FOUND);
    }
}
