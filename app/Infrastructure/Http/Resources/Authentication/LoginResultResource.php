<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Resources\Authentication;

use App\Domain\ValueObjects\Authentication\LoginResultVO;
use App\Infrastructure\Http\Resources\User\UserResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="LoginResultResource",
 *
 *     @OA\Property(
 *         property="token",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="user",
 *         type="object",
 *         ref="#/components/schemas/UserResource"
 *     )
 * )
 *
 * @mixin LoginResultVO
 */
final class LoginResultResource extends Resource
{
    public function getResponseArray(): array
    {
        return [
            'token' => $this->token,
            'user' => new UserResource($this->user),
        ];
    }
}
