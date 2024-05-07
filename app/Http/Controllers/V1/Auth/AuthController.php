<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\AuthInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\Api\V1\Cms\User\UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    private AuthInterface $auth;

    public function __construct(AuthInterface $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        try {
            $emailOrUsername = $request->get('email_or_username');
            $password = $request->get('password');

            $fieldLogin = 'username';

            if (filter_var($emailOrUsername, FILTER_VALIDATE_EMAIL)) {
                $fieldLogin = 'email';
            }

            $credentials = [$fieldLogin => strtolower($emailOrUsername), 'password' => $password];

            $validator = Validator::make($request->all(), [
                'email_or_username' => ['required', 'string'],
                'password' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
            }

            $token = $this->auth->login($credentials, $fieldLogin);

            return $this->respondWithToken($token);
        } catch (ValidationException $validationException) {
            return response()->json($validationException->errors(), Response::HTTP_BAD_REQUEST);
        } catch (AuthenticationException $e) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Get the authenticated UserEloquentModel.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json($this->auth->me()->toArray());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->auth->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        try {
            $token = $this->auth->refresh();
        } catch (AuthenticationException $e) {
            return response()->json(['status' => $e->getMessage()], Response::HTTP_FORBIDDEN);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'user' => new UserResource($this->auth->me()),
            'accessToken' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 1,
        ]);
    }
}
