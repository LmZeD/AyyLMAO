<?php

namespace App\Providers;

use App\Repositories\CategoryInterface;
use App\Repositories\CategoryRepository;
use App\Services\Category\IterativeChildrenCollectorService;
use App\Services\Category\PrepareDataForPrintingService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('IterativeChildrenCollectorService', IterativeChildrenCollectorService::class);
        $this->app->singleton('PrepareDataForPrintingService', PrepareDataForPrintingService::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
    }
}
