<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobListingRequest;
use App\Http\Resources\JobListingResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class JobListingController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobListing = JobListing::paginate();

        return $this->apiResponse(JobListingResource::collection($jobListing)->resource, 'all jobs', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobListingRequest $request)
    {
        $job = JobListing::create([
            'employer_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'salary_from' => $request->salary_from,
            'salary_to' => $request->salary_to,
            'employemnt_type' => $request->employemnt_type,
            'status' => $request->status,
            'posted_at' => now(),
            'expires_at' => $request->expires_at,
        ]);

        return $this->apiResponse(JobListingResource::make($job), 'new job was created successfully', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(JobListing $job)
    {
        return $this->apiResponse(JobListingResource::make($job), 'the details of a job', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobListingRequest $request, JobListing $job)
    {
        if (Gate::allows('job-listing', $job)) {
            $job->update([
                'employer_id' => Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'location' => $request->location,
                'salary_from' => $request->salary_from,
                'salary_to' => $request->salary_to,
                'employemnt_type' => $request->employemnt_type,
                'status' => $request->status,
                'posted_at' => now(),
                'expires_at' => $request->expires_at,
            ]);

            return $this->apiResponse(JobListingResource::make($job), 'the job was updated successfully', 200);
        }
        return $this->apiResponse(null, 'unauthorized access', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobListing $job)
    {
        $job->delete();
        return $this->apiResponse(JobListingResource::make($job), 'the job was deleted successfully', 200);
    }
}
