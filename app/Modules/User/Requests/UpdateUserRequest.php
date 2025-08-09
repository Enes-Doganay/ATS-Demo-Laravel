<?php

namespace App\Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->route('user');
        
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $userId,
            'password' => [
                'sometimes',
                'string',
                Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(),
            ],
            'role' => 'sometimes|in:admin,recruiter'
        ];
    }
}