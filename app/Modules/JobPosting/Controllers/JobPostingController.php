<?php

namespace App\Modules\JobPosting\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\JobPosting\Requests\StoreJobPostingRequest;
use App\Modules\JobPosting\Requests\UpdateJobPostingRequest;
use App\Modules\JobPosting\Resources\JobPostingResource;
use App\Modules\JobPosting\Services\JobPostingService;

class JobPostingController extends Controller
{
    protected $jobPostingService;

    public function __construct(JobPostingService $jobPostingService)
    {
        $this->jobPostingService = $jobPostingService;
    }

    public function index()
    {
        $jobPostings = $this->jobPostingService->getAllJobPostings();
        return JobPostingResource::collection($jobPostings);
    }

    public function show($id)
    {
        $jobPosting = $this->jobPostingService->getJobPostingById($id);
        return new JobPostingResource($jobPosting);
    }

    public function store(StoreJobPostingRequest $request)
    {
        $jobPosting = $this->jobPostingService->createJobPosting($request->validated());
        return new JobPostingResource($jobPosting);
    }

    public function update(UpdateJobPostingRequest $request, $id)
    {
        $updated = $this->jobPostingService->updateJobPosting($id, $request->validated());
        return new JobPostingResource($updated);
    }

    public function destroy($id)
    {
        $this->jobPostingService->deleteJobPosting($id);
        return response()->json(null, 204);
    }
}