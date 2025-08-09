<?php

namespace App\Modules\Application\Repositories;

use App\Modules\Application\Models\Application;
use App\Shared\Repositories\BaseRepository;

class EloquentApplicationRepository extends BaseRepository implements ApplicationRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new Application());
    }

}