<?php

namespace App\Interfaces\Services;

use App\Models\User;

interface UserServiceInterface
{
    public function create(array $data);

    public function update(User $user, array $data);

    public function delete(User $user);
}
