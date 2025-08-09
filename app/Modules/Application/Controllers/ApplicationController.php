<?php

namespace App\Modules\Application\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Application\Requests\StoreApplicationRequest;
use App\Modules\Application\Requests\UpdateApplicationRequest;
use App\Modules\Application\Resources\ApplicationResource;
use App\Modules\Application\Services\ApplicationService;

class ApplicationController extends Controller
{
    protected $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    public function index()
    {
        $applications = $this->applicationService->getAllApplications(); 
        return ApplicationResource::collection($applications);
    }

    public function show($id)
    {
        $application = $this->applicationService->getApplicationById($id);
        return new ApplicationResource($application);
    }

    public function store(StoreApplicationRequest $request)
    {
        $application = $this->applicationService->createApplication($request->validated());
        return new ApplicationResource($application);
    }

    public function update(UpdateApplicationRequest $request, $id)
    {
        $application = $this->applicationService->updateApplication($id, $request->validated());
        return new ApplicationResource($application);
    }

    public function destroy($id)
    {
        $this->applicationService->deleteApplication($id);
        return response()->json(null, 204);
    }
}