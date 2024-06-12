<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Resources\User;

use App\Domain\Entities\User;
use App\Infrastructure\Http\Resources\Authentication\Resource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="UserResource",
 *
 *     @OA\Property(
 *         property="id",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string"
 *     )
 * )
 *
 * @mixin User
 */
final class UserResource extends Resource
{
    public function getResponseArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
        ];
    }
}
