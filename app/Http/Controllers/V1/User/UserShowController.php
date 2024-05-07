<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Cms\User\UserResource;
use App\Interfaces\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Http\Request;

class UserShowController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {
        $this->resourceItem = UserResource::class;
    }

    public function __invoke(Request $request, User $user): UserResource
    {
        $allowedIncludes = [
            'role',
        ];

        if ($request->has('include')) {
            $with = array_intersect($allowedIncludes, explode(',', strtolower($request->get('include'))));
            $user = $user->load($with);
        }

        return $this->respondWithItem($user);
    }
}
