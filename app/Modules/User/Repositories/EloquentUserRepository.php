<?php

namespace App\Modules\User\Repositories;

use App\Modules\User\Models\User;
use App\Shared\Repositories\BaseRepository;

class EloquentUserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct() {
        parent::__construct(new User());
    }
}