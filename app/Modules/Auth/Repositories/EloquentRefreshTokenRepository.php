<?php

namespace App\Modules\Auth\Repositories;

use App\Modules\Auth\Models\RefreshToken;
use App\Shared\Repositories\BaseRepository;

class EloquentRefreshTokenRepository extends BaseRepository implements RefreshTokenRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new RefreshToken());
    }

    public function findValidToken(string $token): ?RefreshToken
    {
        return $this->model::where('token', $token)
            ->where('revoked', false)
            ->where('expires_at', '>', now())
            ->first();
    }

    public function revokeByUserId(int $id): void
    {
        $this->model::where('user_id', $id)->update(['revoked' => true]);
    }

    public function revokeToken(int $id): void
    {
        $this->model::where('id', $id)->update(['revoked' => true]);
    }
}