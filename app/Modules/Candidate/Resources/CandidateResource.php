<?php


namespace App\Modules\Candidate\Resources;

use App\Modules\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidateResource extends JsonResource
{
    public function toArray($request)
{
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'resume_url' => $this->resume_url,
            // 'user' => new UserResource($this->whenLoaded('user'))
        ];
    }
}