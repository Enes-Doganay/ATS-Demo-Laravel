<?php

namespace App\Modules\Candidate\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Candidate\Requests\StoreCandidateRequest;
use App\Modules\Candidate\Requests\UpdateCandidateRequest;
use App\Modules\Candidate\Resources\CandidateResource;
use App\Modules\Candidate\Services\CandidateService;

class CandidateController extends Controller
{
    protected $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    public function index()
    {
        $candidates = $this->candidateService->getAllCandidates();
        return CandidateResource::collection($candidates);
    }

    public function show($id)
    {
        $candidate = $this->candidateService->getCandidateById($id);
        return new CandidateResource($candidate);
    }

    public function store(StoreCandidateRequest $request)
    {
        $candidate = $this->candidateService->createCandidate($request->validated());
        return new CandidateResource($candidate);
    }

    public function update(UpdateCandidateRequest $request, $id)
    {
        $updated = $this->candidateService->updateCandidate($id, $request->validated());
        return new CandidateResource($updated);
    }

    public function destroy($id)
    {
        $this->candidateService->deleteCandidate($id);
        return response()->json(null, 204);
    }
}