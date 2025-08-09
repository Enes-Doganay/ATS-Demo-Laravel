<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Candidate\Controllers\CandidateController;
use App\Modules\User\Controllers\UserController;
use App\Modules\JobPosting\Controllers\JobPostingController;
use App\Modules\Application\Controllers\ApplicationController;

Route::apiResource('candidates', CandidateController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('job-postings', JobPostingController::class);
Route::apiResource('applications', ApplicationController::class);
