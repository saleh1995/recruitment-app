<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
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
            'job_seeker_id' => $this->job_seeker_id ? UserResource::make($this->jobSeeker) : null,
            'job_listing_id' => $this->job_listing_id ? JobListingResource::make($this->joblisting) : null,
            'letter' => $this->letter,
            'cv' => $this->cv,
            'accepted' => $this->accepted,
        ];
    }
}
