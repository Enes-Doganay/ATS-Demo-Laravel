<?php

namespace App\Modules\Candidate\Controllers;

use App\Http\Controllers\Controller;
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
        return response()->json($candidates);
    }

    public function show($id)
    {
        $candidate = $this->candidateService->getCandidateById($id);
        if (!$candidate) {
            return response()->json(['message' => 'Candidate not found'], 404);
        }
        return response()->json($candidate);
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
        return response()->json($candidate, 201);
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

        if (!$updated) {
            return response()->json(['message' => 'Candidate not found or update failed'], 404);
        }
        
        return response()->json(['message' => 'Candidate updated successfully']);
    }

    public function destroy($id)
    {
        $deleted = $this->candidateService->deleteCandidate($id);

        if (!$deleted) {
            return response()->json(['message' => 'Candidate not found or delete failed'], 404);
        }
            
        return response()->json(['message' => 'Candidate deleted successfully']);
    }
}