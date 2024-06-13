<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Requests\Authentication;

use App\Application\UseCases\DTO\LoginUserUseCaseDTO;
use App\Infrastructure\Http\Requests\FormRequest;
use Illuminate\Validation\Rules\Password;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="LoginRequest",
 *     required={"email", "password"},
 *
 *     @OA\Property(
 *          property="email",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="password",
 *          type="string"
 *     )
 * )
 */
final class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)],
        ];
    }

    public function getLoginUserUseCaseDTO(): LoginUserUseCaseDTO
    {
        return new LoginUserUseCaseDTO(
            $this->validated('email'),
            $this->validated('password'),
        );
    }
}
