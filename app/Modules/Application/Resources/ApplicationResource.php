<?php

namespace App\Modules\Application\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'candidate_id' => $this->candidate_id,
            'job_posting_id' => $this->job_posting_id,
            'applied_at' => $this->applied_at,
            'status' => $this->status,
        ];
    }
}