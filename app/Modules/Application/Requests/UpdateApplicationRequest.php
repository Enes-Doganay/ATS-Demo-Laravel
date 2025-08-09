<?php

namespace App\Modules\Application\Requests;

use App\Modules\Application\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'candidate_id' => 'sometimes|exists:candidates,id',
            'job_posting_id' => 'sometimes|exists:job_postings,id',
            'applied_at' => 'sometimes|date',
            'status' => 'nullable|in:applied,rejected,shortlisted',
        ];
    }
}