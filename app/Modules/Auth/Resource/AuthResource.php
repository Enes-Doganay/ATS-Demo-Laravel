<?php

namespace App\Modules\Auth\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'access_token' => $this['access_token'],
            'token_type' => $this['token_type'],
            'refresh_token' => $this['refresh_token'],
            'refresh_token_expires_at' => $this['refresh_token_expires_at'],
            'user' => $this['user'],
        ];
    }
}