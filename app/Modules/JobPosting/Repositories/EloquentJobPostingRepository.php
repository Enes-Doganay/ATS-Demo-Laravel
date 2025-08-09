<?php

namespace App\Modules\JobPosting\Repositories;

use App\Modules\JobPosting\Models\JobPosting;
use App\Shared\Repositories\BaseRepository;

class EloquentJobPostingRepository extends BaseRepository implements JobPostingRepositoryInterface
{
    public function __construct() {
        parent::__construct(new JobPosting());
    }
}