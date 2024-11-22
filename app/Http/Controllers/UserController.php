<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private AuthService $authService;
    private UserService $userService;

    public function __construct(AuthService $authService, UserService $userService)
    {
        $this->authService = $authService;
        $this->userService = $userService;
    }

    public function getUser(Request $request): JsonResponse
    {
        $rawToken = $request->header('Authorization');

        if (!$rawToken) {
            return response()->json([
                'error' => 'Authorization header is required.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $this->authService->extractToken($rawToken);

        if (!$token) {
            return response()->json([
                'error' => 'Invalid Authorization header format.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = $this->userService->getUserById($token);

        if (!$user) {
            return response()->json([
                'error' => 'User not found',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'commands' => $user->commands,
        ], Response::HTTP_OK);
    }
}
