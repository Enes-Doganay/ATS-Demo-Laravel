<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Candidate\Controllers\CandidateController;
use App\Modules\User\Controllers\UserController;

Route::apiResource('candidates', CandidateController::class);

Route::apiResource('users', UserController::class);
