<?php

namespace App\Modules\JobPosting\Services;

use App\Modules\JobPosting\Repositories\JobPostingRepositoryInterface;
use App\Shared\Exceptions\EntityNotFoundError;

class JobPostingService
{
    protected $repository;

    public function __construct(JobPostingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllJobPostings()
    {
        return $this->repository->all();
    }

    public function getJobPostingById(int $id)
    {
        $jobPosting = $this->repository->find($id);

        if (!$jobPosting) {
            throw new EntityNotFoundError('Job Posting', $id);
        }

        return $jobPosting;
    }

    public function createJobPosting(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateJobPosting(int $id, array $data)
    {
        $updated = $this->repository->update($id, $data);

        if (!$updated) {
            throw new EntityNotFoundError('Job Posting', $id);
        }

        return $updated;
    }

    public function deleteJobPosting(int $id)
    {
        $deleted = $this->repository->delete($id);

        if (!$deleted) {
            throw new EntityNotFoundError('Job Posting', $id);
        }
    }
}