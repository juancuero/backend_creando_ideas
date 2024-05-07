<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;

interface AuthInterface
{
    /**
     * @throws AuthenticationException
     */
    public function login(array $credentials, string $fieldLogin): string;

    /**
     * @throws AuthenticationException
     */
    public function refresh(): string;

    public function logout(): void;

    public function me(): User;
}
