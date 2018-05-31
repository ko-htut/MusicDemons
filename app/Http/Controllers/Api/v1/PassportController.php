<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\LoginRequest;

class PassportController extends Controller
{
    private AuthService $authService;
    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request) {
        $user = $this->authService->register($request->getCredentials());
        return response()->json([
            'message' => 'Account created successfully',
            'token'   => $user->createToken(config('app.name', 'Laravel'))
        ], 200);
    }
    
    public function login(LoginRequest $request) {
        return "login";
    }
}
