<?php

namespace App\Modules\Candidate\Repositories;

use App\Modules\Candidate\Models\Candidate;
use Illuminate\Support\Collection;

interface CandidateRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): ?Candidate;
    public function create(array $data): Candidate;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}