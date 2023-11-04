<?php

namespace App\Http\Controllers\Api;

use App\Models\Application;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\ApplicationRequest;
use App\Http\Requests\UpdateApplicationAcceptedAttributeRequest;
use App\Http\Requests\UpdateApplicationCVAttributeRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Http\Traits\FileHandlingTrait;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    use ApiResponseTrait, FileHandlingTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::paginate();

        return $this->apiResponse(ApplicationResource::collection($applications)->resource, 'all jobs', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApplicationRequest $request)
    {

        $application = Application::create([
            'job_seeker_id' => Auth::user()->id,
            'job_listing_id' => $request->job_listing_id,
            'letter' => $request->letter,
            'cv' => $this->saveFile($request->cv, 'Cv'),
        ]);

        return $this->apiResponse(ApplicationResource::make($application), 'new job application was created successfully', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        return $this->apiResponse(ApplicationResource::make($application), 'the details of a job application', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplicationRequest $request, Application $application)
    {
        $application->update([
            'job_listing_id' => $request->job_listing_id,
            'letter' => $request->letter,
        ]);

        return $this->apiResponse(ApplicationResource::make($application), 'the job application was updated successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        $application->delete();
        return $this->apiResponse(ApplicationResource::make($application), 'the job application was deleted successfully', 200);
    }


    //update the cv field 
    public function updateCvField(UpdateApplicationCVAttributeRequest $request, Application $application){
        $application->update([
            'cv' => $this->updateFile($application, $request, 'cv', 'Cv'),
        ]);

        return $this->apiResponse(ApplicationResource::make($application), 'the job application CV field was updated successfully', 200);
    }


    //update the accepted field 
    public function updateAcceptedField(UpdateApplicationAcceptedAttributeRequest $request, Application $application){
        $application->update([
            'accepted' => $request->accepted,
        ]);

        return $this->apiResponse(ApplicationResource::make($application), 'the job application accepted field was updated successfully', 200);
    }
}
