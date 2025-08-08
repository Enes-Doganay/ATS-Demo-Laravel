<?php

namespace App\Modules\Candidate\Services;

use App\Modules\Candidate\Repositories\CandidateRepositoryInterface;

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
        return $this->repository->find($id);
    }

    public function createCandidate(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateCandidate(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteCandidate(int $id)
    {
        return $this->repository->delete($id);
    }
}