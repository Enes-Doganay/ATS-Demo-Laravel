<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Candidate\Controllers\CandidateController;
use App\Modules\User\Controllers\UserController;
use App\Modules\JobPosting\Controllers\JobPostingController;
use App\Modules\Application\Controllers\ApplicationController;
use App\Modules\Auth\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/refresh-token', [AuthController::class, 'refresh']);

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('job-postings', JobPostingController::class)->except(['index', 'show']);
});

Route::middleware(['auth:sanctum', 'role:admin,recruiter'])->group(function () {
    Route::apiResource('candidates', CandidateController::class);
    Route::apiResource('applications', ApplicationController::class);
    Route::get('job-postings', [JobPostingController::class, 'index']);
    Route::get('job-postings/{id}', [JobPostingController::class, 'show']);
});
