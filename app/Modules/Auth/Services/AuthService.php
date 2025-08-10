<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Repositories\RefreshTokenRepositoryInterface;
use App\Shared\Exceptions\InvalidCredentialsError;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthService
{
    protected $refreshTokenRepository;

    public function __construct(RefreshTokenRepositoryInterface $refreshTokenRepository) {
        $this->refreshTokenRepository = $refreshTokenRepository;
    }

    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            throw new InvalidCredentialsError();
        }
        $user = Auth::user();
        $accessToken = $user->createToken('auth_token')->plainTextToken;

        $refreshToken = Str::random(env('REFRESH_TOKEN_LENGTH', 64));
        $expiresAt = Carbon::now()->addDays((int)env('REFRESH_TOKEN_TTL_DAYS', 7));
        $this->refreshTokenRepository->create([
            'user_id' => $user->id,
            'token' => $refreshToken,
            'expires_at' => $expiresAt,
            'revoked' => false,
        ]);

        return [
            'access_token' => $accessToken,
            'token_type' => 'Bearer',
            'refresh_token' => $refreshToken,
            'refresh_token_expires_at' => $expiresAt,
            'user' => $user
        ];
    }

    public function logout($user)
    {
        $user->tokens()->delete();
        $this->refreshTokenRepository->revokeByUserId($user->id);
        return ['message' => 'Logged out'];
    }

    public function refresh($refreshToken)
    {
        $refreshTokenModel = $this->refreshTokenRepository->findValidToken($refreshToken);

        if (!$refreshTokenModel) {
            throw new InvalidCredentialsError('Invalid or expired refresh token');
        }

        $user = $refreshTokenModel->user;
        $accessToken = $user->createToken('auth_token')->plainTextToken;

        $this->refreshTokenRepository->revokeToken($refreshTokenModel->id);

        $newRefreshToken = Str::random(env('REFRESH_TOKEN_LENGTH', 64));
        $expiresAt = Carbon::now()->addDays((int)env('REFRESH_TOKEN_TTL_DAYS', 7));
        $this->refreshTokenRepository->create([
            'user_id' => $user->id,
            'token' => $newRefreshToken,
            'expires_at' => $expiresAt,
            'revoked' => false,
        ]);

        return [
            'access_token' => $accessToken,
            'token_type' => 'Bearer',
            'refresh_token' => $newRefreshToken,
            'refresh_token_expires_at' => $expiresAt,
            'user' => $user
        ];
    }
}