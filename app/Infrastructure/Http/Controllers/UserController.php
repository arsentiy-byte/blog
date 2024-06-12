<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controllers;

use App\Application\UseCases\UserUseCase;
use App\Infrastructure\Http\Requests\User\ManageRequest;
use App\Infrastructure\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

final class UserController extends Controller
{
    /**
     * @OA\Post(
     *      summary="Create user",
     *      path="/api/users",
     *      operationId="users-create",
     *      tags={"users"},
     *      description="Creates user",
     *      parameters={
     *        {"name":"Authorization", "in":"header", "type":"string", "required":true, "description":"Bearer token"}
     *       },
     *
     *      @OA\RequestBody(
     *
     *          @OA\MediaType(
     *              mediaType="application/json",
     *
     *              @OA\Schema(ref="#/components/schemas/ManageUserRequest")
     *          )
     *      ),
     *
     *      @OA\Response(
     *           response=201,
     *           description="User has successfully created"
     *      )
     *  )
     */
    public function create(ManageRequest $request, UserUseCase $useCase): JsonResponse
    {
        $useCase->create(Str::uuid()->toString(), $request->getCreateUserUseCaseDTO());

        return $this->response(
            message: 'User has successfully created',
            code: Response::HTTP_CREATED,
        );
    }

    /**
     * @OA\Put(
     *      summary="Update user",
     *      path="/api/users/{user}",
     *      operationId="users-update",
     *      tags={"users"},
     *      description="Updates user",
     *      parameters={
     *          {"name":"Authorization", "in":"header", "type":"string", "required":true, "description":"Bearer token"},
     *          {
     *              "name":"user",
     *              "in":"path",
     *              "type":"string",
     *              "required":true,
     *              "example":"8c002ba4-945e-460f-993c-33c7707f1c7b",
     *              "description":"User ID"
     *         }
     *       },
     *
     *      @OA\RequestBody(
     *
     *          @OA\MediaType(
     *              mediaType="application/json",
     *
     *              @OA\Schema(ref="#/components/schemas/ManageUserRequest")
     *          )
     *      ),
     *
     *      @OA\Response(
     *           response=200,
     *           description="User has successfully updated"
     *      )
     *  )
     */
    public function update(User $user, ManageRequest $request, UserUseCase $useCase): JsonResponse
    {
        $useCase->update($user->entity(), $request->getUpdateUserUseCaseDTO());

        return $this->response('User has successfully updated');
    }

    /**
     * @OA\Delete(
     *      summary="Delete user",
     *      path="/api/users/{user}",
     *      operationId="users-delete",
     *      tags={"users"},
     *      description="Deletes user",
     *      parameters={
     *          {"name":"Authorization", "in":"header", "type":"string", "required":true, "description":"Bearer token"},
     *          {
     *              "name":"user",
     *              "in":"path",
     *              "type":"string",
     *              "required":true,
     *              "example":"8c002ba4-945e-460f-993c-33c7707f1c7b",
     *              "description":"User ID"
     *         }
     *       },
     *
     *      @OA\Response(
     *           response=204,
     *           description="User has successfully deleted"
     *      )
     *  )
     */
    public function delete(User $user, UserUseCase $useCase): JsonResponse
    {
        $useCase->delete($user->entity());

        return $this->response(
            message: 'User has successfully deleted',
            code: Response::HTTP_NO_CONTENT,
        );
    }
}
