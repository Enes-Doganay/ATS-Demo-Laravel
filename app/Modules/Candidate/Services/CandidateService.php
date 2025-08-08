<?php

namespace App\Modules\Candidate\Services;

use App\Modules\Candidate\Repositories\CandidateRepositoryInterface;
use App\Shared\Exceptions\EntityNotFoundError;

class CandidateService
{
    protected $repository;

    public function __construct(CandidateRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllCandidates()
    {
        return $this->repository->all();
    }

    public function getCandidateById(int $id)
    {
        $candidate = $this->repository->find($id);

        if (!$candidate) {
            throw new EntityNotFoundError('Candidate', $id);
        }

        return $candidate;
    }

    public function createCandidate(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateCandidate(int $id, array $data)
    {
        $updated = $this->repository->update($id, $data);

        if (!$updated) {
            throw new EntityNotFoundError('Candidate', $id);
        }

        return $updated;
    }

    public function deleteCandidate(int $id)
    {
        $deleted = $this->repository->delete($id);

        if (!$deleted) {
            throw new EntityNotFoundError('Candidate', $id);
        }
    }
}