<?php

namespace App\Modules\Auth\Repositories;

use App\Modules\Auth\Models\RefreshToken;
use App\Shared\Interfaces\BaseRepositoryInterface;

interface RefreshTokenRepositoryInterface extends BaseRepositoryInterface
{
    public function findValidToken(string $token): ?RefreshToken;
    public function revokeByUserId(int $id): void;
    public function revokeToken(int $id): void;
}