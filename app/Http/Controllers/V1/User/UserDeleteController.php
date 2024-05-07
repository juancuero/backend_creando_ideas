<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Services\UserServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;

class UserDeleteController extends Controller
{
    public function __construct(private UserServiceInterface $userService)
    {
    }

    public function __invoke(Request $request, User $user)
    {
        $this->userService->delete($user);

        return $this->respondWithNoContent();
    }
}
