<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Requests\User;

use App\Application\UseCases\DTO\CreateUserUseCaseDTO;
use App\Application\UseCases\DTO\UpdateUserUseCaseDTO;
use App\Infrastructure\Http\Requests\FormRequest;
use Illuminate\Validation\Rules\Password;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ManageUserRequest",
 *     required={"name", "email", "password"},
 *
 *     @OA\Property(
 *         property="name",
 *         type="string"
 *      ),
 *     @OA\Property(
 *          property="email",
 *          type="string"
 *      ),
 *     @OA\Property(
 *          property="password",
 *          type="string"
 *      )
 * )
 */
final class ManageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ];
    }

    public function getCreateUserUseCaseDTO(): CreateUserUseCaseDTO
    {
        return new CreateUserUseCaseDTO(
            $this->validated('name'),
            $this->validated('email'),
            $this->validated('password'),
        );
    }

    public function getUpdateUserUseCaseDTO(): UpdateUserUseCaseDTO
    {
        return new UpdateUserUseCaseDTO(
            $this->validated('name'),
            $this->validated('email'),
            $this->validated('password'),
        );
    }
}
