<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\UserCreateRequest;
use App\Http\Resources\Api\V1\Cms\User\UserResource;
use App\Interfaces\Services\UserServiceInterface;

class UserCreateController extends Controller
{
    public function __construct(private UserServiceInterface $userService)
    {
        $this->resourceItem = UserResource::class;
    }

    public function __invoke(UserCreateRequest $request)
    {
        $user = $this->userService->create($request->all());
        $user = $user->load('role');

        return $this->respondWithItem($user);
    }
}
