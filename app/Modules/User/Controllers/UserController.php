<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Requests\StoreUserRequest;
use App\Modules\User\Requests\UpdateUserRequest;
use App\Modules\User\Resources\UserResource;
use App\Modules\User\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return UserResource::collection($users);
    }

    public function show(int $id)
    {
        $user = $this->userService->getUserById($id);
        return new UserResource($user);
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $updated = $this->userService->updateUser($id, $request->validated());
        return new UserResource($updated);
    }

    public function destroy(int $id)
    {
        $this->userService->deleteUser($id);
        return response()->json(null, 204);
    }
}