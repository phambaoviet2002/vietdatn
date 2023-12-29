<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\headerComposer;
use Illuminate\Support\Facades\Blade;



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
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        // Đăng ký Blade View Composer
        View::composer('AdminRocker.share.menu', headerComposer::class);
        View::composer('AdminRocker.share.menu', headerComposer::class);
        Blade::directive('currency', function ($expression) {
            return "number_format($expression, 0, ',', '.') . ' ₫'";
        });
    }
}