<?php

namespace App\Modules\User\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Modules\User\Enums\UserRole;

class User extends Authenticatable {
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $casts = [
        'role' => UserRole::class
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}
