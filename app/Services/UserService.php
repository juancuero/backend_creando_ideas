<?php

namespace App\Services;

use App\Interfaces\Repositories\UserRepository;
use App\Interfaces\Services\UserServiceInterface;
use App\Models\User;

class UserService implements UserServiceInterface
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function create(array $data)
    {
        $password = randomText(8);
        $data['password'] = $password;
        //send password email
        return $this->userRepository->store($data);
    }

    public function update(User $user, array $data)
    {
        /*
        if (isset($data['password'])) {
             send PasswordReset
        }
        */
        return $this->userRepository->update($user, $data);
    }

    public function delete(User $user)
    {
        /*
         Validations
        */

        //se deberia cambiar el estado o usar softdelete.
        return $this->userRepository->deleteById($user->id);
    }
}
