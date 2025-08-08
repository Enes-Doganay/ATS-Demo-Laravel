<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Candidate\Controllers\CandidateController;

Route::apiResource('candidates', CandidateController::class);
