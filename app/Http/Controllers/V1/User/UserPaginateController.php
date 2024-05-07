<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserPaginateController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(Request $request)
    {
        $users = $this->userRepository->findByFilters();

        return $this->respondWithCustomData($users);
    }
}
