<?php

namespace App\Modules\Candidate\Repositories;

use App\Modules\Candidate\Models\Candidate;
use App\Shared\Repositories\BaseRepository;

class EloquentCandidateRepository extends BaseRepository implements CandidateRepositoryInterface
{
    public function __construct() {
        parent::__construct(new Candidate());
    }
}