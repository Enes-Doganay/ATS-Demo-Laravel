<?php

namespace App\Modules\Candidate\Repositories;

use App\Modules\Candidate\Models\Candidate;
use Illuminate\Support\Collection;

class EloquentCandidateRepository implements CandidateRepositoryInterface
{
    protected $model;

    public function __construct(Candidate $candidate) {
        $this->model = $candidate;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): ?Candidate
    {
        return $this->model->find($id);
    }

    public function create(array $data): Candidate
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $candidate = $this->model->find($id);
        return $candidate ? $candidate->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $candidate = $this->find($id);
        return $candidate ? $candidate->delete() : false;
    }
}