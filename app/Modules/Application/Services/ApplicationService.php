<?php

namespace App\Modules\Application\Services;

use App\Modules\Application\Repositories\ApplicationRepositoryInterface;
use App\Shared\Exceptions\EntityNotFoundError;

class ApplicationService {
    protected $repository;

    public function __construct(ApplicationRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function getAllApplications() {
        return $this->repository->all();
    }

    public function getApplicationById($id) {
        $application = $this->repository->find($id);

        if (!$application) {
            throw new EntityNotFoundError('Application', $id);
        }

        return $application;
    }

    public function createApplication(array $data) {
        return $this->repository->create($data);
    }

    public function updateApplication($id, array $data) {
        $updated = $this->repository->update($id, $data);

        if (!$updated) {
            throw new EntityNotFoundError('Application', $id);
        }

        return $updated;
    }

    public function deleteApplication($id) {
        $deleted = $this->repository->delete($id);

        if (!$deleted) {
            throw new EntityNotFoundError('Application', $id);
        }
    }
}