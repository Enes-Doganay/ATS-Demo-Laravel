<?php

namespace App\Providers;

use App\Modules\Application\Repositories\ApplicationRepositoryInterface;
use App\Modules\Application\Repositories\EloquentApplicationRepository;
use Illuminate\Support\ServiceProvider;
use App\Modules\Candidate\Repositories\CandidateRepositoryInterface;
use App\Modules\Candidate\Repositories\EloquentCandidateRepository;
use App\Modules\JobPosting\Repositories\EloquentJobPostingRepository;
use App\Modules\JobPosting\Repositories\JobPostingRepositoryInterface;
use App\Modules\User\Repositories\EloquentUserRepository;
use App\Modules\User\Repositories\UserRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(
            CandidateRepositoryInterface::class,
            EloquentCandidateRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            EloquentUserRepository::class
        );

        $this->app->bind(
            JobPostingRepositoryInterface::class,
            EloquentJobPostingRepository::class
        );

        $this->app->bind(
            ApplicationRepositoryInterface::class,
            EloquentApplicationRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
