<?php

namespace App\Modules\User\Services;

use App\Modules\User\Enums\UserRole;
use App\Modules\User\Repositories\UserRepositoryInterface;
use App\Shared\Exceptions\EntityNotFoundError;

class UserService
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllUsers()
    {
        return $this->repository->all();
    }

    public function getUserById(int $id)
    {
        $user = $this->repository->find($id);

        if (!$user) {
            throw new EntityNotFoundError('User', $id);
        }

        return $user;
    }

    public function createUser(array $data)
    {
        $data['password'] = bcrypt($data['password']);

        if (!isset($data['role'])) {
            $data['role'] = UserRole::RECRUITER;
        }

        return $this->repository->create($data);
    }

    public function updateUser(int $id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        if (isset($data['role']) && is_string($data['role'])) {
            $data['role'] = UserRole::from($data['role']);
        }

        $updated = $this->repository->update($id, $data);

        if (!$updated) {
            throw new EntityNotFoundError('User', $id);
        }

        return $updated;
    }

    public function deleteUser(int $id)
    {
        $deleted = $this->repository->delete($id);

        if (!$deleted) {
            throw new EntityNotFoundError('User', $id);
        }
    }
}