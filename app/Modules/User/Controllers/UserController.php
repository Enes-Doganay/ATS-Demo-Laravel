<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Resources\UserResource;
use App\Modules\User\Services\UserService;

;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'sometimes|in:admin,recruiter'
        ]);
        $user = $this->userService->createUser($validated);
        return new UserResource($user);
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email',
            'password' => 'sometimes|string|min:8',
            'role' => 'sometimes|in:admin,recruiter'
        ]);
        
        $updated = $this->userService->updateUser($id, $validated);
        return new UserResource($updated);
    }

    public function destroy(int $id)
    {
        $this->userService->deleteUser($id);
        return response()->json(null, 204);
    }
}