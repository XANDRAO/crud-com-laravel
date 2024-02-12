<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // Corrected import statement for Schema
use App\Models\Category; // Assuming Category is in the App\Models namespace

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
        Schema::defaultStringLength(191); 

        view()->composer(
            'admin.products.*',
            function ($view) {
                $view->with('categories', Category::pluck('title', 'id'));
            }
        );
    }
}
