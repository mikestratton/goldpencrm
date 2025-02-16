<?php

namespace App\Providers;

use App\Models\Prospect;
use App\Policies\ProspectPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Prospect::class, ProspectPolicy::class);
    }
}
