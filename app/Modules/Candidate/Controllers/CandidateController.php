<?php

namespace App\Modules\Candidate\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Candidate\Resources\CandidateResource;
use App\Modules\Candidate\Services\CandidateService;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'resume_url' => 'nullable|string',
        ]);

        $candidate = $this->candidateService->createCandidate($validated);
        return new CandidateResource($candidate);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'resume_url' => 'nullable|url',
        ]);
        
        $updated = $this->candidateService->updateCandidate($id, $validated);
        return new CandidateResource($updated);
    }

    public function destroy($id)
    {
        $this->candidateService->deleteCandidate($id);
        return response()->json(null, 204);
    }
}