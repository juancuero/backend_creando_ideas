<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Cms\User\UserCollection;
use App\Interfaces\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserIndexController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {
        $this->resourceCollection = UserCollection::class;
    }

    public function __invoke(Request $request)
    {
        $users = $this->userRepository->all();

        return $this->respondWithCustomData($users);
    }
}
