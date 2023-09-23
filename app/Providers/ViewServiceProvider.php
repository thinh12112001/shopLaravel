<?php

namespace App\Providers;

use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\MenuComposer;
use App\Http\View\Composers\CartComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('header', MenuComposer::class);
        View::composer('cart', CartComposer::class);
    }
}
