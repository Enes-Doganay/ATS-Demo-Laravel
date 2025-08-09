<?php


namespace App\Modules\JobPosting\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobPostingResource extends JsonResource
{
    public function toArray($request)
{
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'posted_by' => $this->posted_by,
        ];
    }
}