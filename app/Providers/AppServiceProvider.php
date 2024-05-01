<?php

namespace App\Providers;

use App\Models\Subscription;
use App\Services\PlanService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

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
        Paginator::useBootstrap();
        View::share('planService', new PlanService());
        Cashier::useSubscriptionModel(Subscription::class);
    }
}
