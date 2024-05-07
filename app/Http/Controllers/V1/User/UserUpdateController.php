<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\UserUpdateRequest;
use App\Http\Resources\Api\V1\Cms\User\UserResource;
use App\Interfaces\Services\UserServiceInterface;
use App\Models\User;

class UserUpdateController extends Controller
{
    public function __construct(private UserServiceInterface $userService)
    {
        $this->resourceItem = UserResource::class;
    }

    public function __invoke(UserUpdateRequest $request, User $user)
    {
        $user = $this->userService->update($user, $request->all());
        $user = $user->load('role');

        return $this->respondWithItem($user);
    }
}
