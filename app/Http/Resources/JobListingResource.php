<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employer_id' => $this->employer ? UserResource::make($this->employer) : null,
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'salary_from' => $this->salary_from,
            'salary_to' => $this->salary_to,
            'employemnt_type' => $this->employemnt_type,
            'status' => $this->status,
            'posted_at' => $this->posted_at,
            'expires_at' => $this->expires_at,
            'applicaions' => $this->applicaions ? ApplicationResource::collection($this->applications) : null,
        ];
    }
}
