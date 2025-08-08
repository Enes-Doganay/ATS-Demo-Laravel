<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Candidate\Repositories\CandidateRepositoryInterface;
use App\Modules\Candidate\Repositories\EloquentCandidateRepository;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
