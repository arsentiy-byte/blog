<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controllers;

use App\Application\UseCases\AuthenticationUseCase;
use App\Infrastructure\Http\Requests\Authentication\LoginRequest;
use App\Infrastructure\Http\Resources\Authentication\LoginResultResource;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

final class AuthenticationController extends Controller
{
    /**
     * @OA\Post(
     *      summary="Login",
     *      path="/api/auth/login",
     *      operationId="login",
     *      tags={"authentication"},
     *      description="User logins",
     *
     *      @OA\RequestBody(
     *
     *          @OA\MediaType(
     *              mediaType="application/json",
     *
     *              @OA\Schema(ref="#/components/schemas/LoginRequest")
     *          )
     *      ),
     *
     *      @OA\Response(
     *           response=201,
     *           description="User has successfully signed in",
     *
     *           @OA\JsonContent(ref="#/components/schemas/LoginResultResource")
     *      )
     *  )
     */
    public function login(LoginRequest $request, AuthenticationUseCase $useCase): JsonResponse
    {
        $result = $useCase->login($request->getLoginUserUseCaseDTO());

        return $this->response(
            'User has successfully signed in',
            new LoginResultResource($result),
        );
    }
}
