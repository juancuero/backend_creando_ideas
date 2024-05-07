<?php

namespace App\Services;

use App\Enums\UserStatus;
use App\Interfaces\AuthInterface;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Log;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth as PHPOpenSourceSaverJWTAuth;

class AuthService implements AuthInterface
{
    public function __construct()
    {
    }

    public function login(array $credentials, string $fieldLogin): string
    {
        $user = User::query()->where($fieldLogin, $credentials[$fieldLogin])->first();

        if (!$user || !$user->status->equals(UserStatus::ACTIVE())) {
            throw new AuthenticationException();
        } elseif (!$token = auth()->attempt($credentials)) {
            throw new AuthenticationException();
        }

        return $token;
    }

    public function logout(): void
    {
        auth()->logout();
    }

    public function me(): User
    {
        return auth()->user();
    }

    public function refresh(): string
    {
        try {
            return PHPOpenSourceSaverJWTAuth::parseToken()->refresh();
        } catch (JWTException $e) {
            Log::error($e->getMessage());
            throw new AuthenticationException($e->getMessage());
        }
    }
}
