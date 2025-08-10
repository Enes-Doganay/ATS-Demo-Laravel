<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Requests\LoginRequest;
use App\Modules\Auth\Requests\RefreshTokenRequest;
use App\Modules\Auth\Resource\AuthResource;
use App\Modules\Auth\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request->validated());
        return (new AuthResource($result))->response()->setStatusCode(200);
    }

    public function logout(Request $request)
    {
        $result = $this->authService->logout($request->user());
        return response()->json($result, 200);
    }

    public function refresh(RefreshTokenRequest $request)
    {
        $result = $this->authService->refresh($request->validated()['refresh_token']);
        return (new AuthResource($result))->response()->setStatusCode(200);
    }
}