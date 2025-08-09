<?php

namespace App\Modules\Application\Requests;

use App\Modules\Application\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'candidate_id' => 'required|exists:candidates,id',
            'job_posting_id' => 'required|exists:job_postings,id',
            'applied_at' => 'nullable|date',
            'status' => 'nullable|in:applied,rejected,shortlisted',
        ];
    }

    protected function prepareForValidation()
    {
        if (!$this->has('status')) {
            $this->merge(['status' => 'applied']);
        }

        if (!$this->has('applied_at')) {
            $this->merge(['applied_at' => now()->toDateTimeString()]);
        }
    }
}