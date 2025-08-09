<?php

namespace App\Modules\Candidate\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCandidateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $candidateId = $this->route('candidate');
        
        return [
            'user_id' => 'sometimes|exists:users,id',
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:candidates,email,' . $candidateId,
            'phone' => 'sometimes|string|max:20|unique:candidates,phone,' . $candidateId,
            'resume_url' => 'sometimes|url',
        ];
    }
}
