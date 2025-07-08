<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

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
        // Chỉ chia sẻ danh mục cho layout client.layouts.app
        View::composer('client.layouts.app', function ($view) {
            $view->with('categories', Category::all());
        });
    }
}
