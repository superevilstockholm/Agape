<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Support\Facades\View;

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
        // Jangan dencrypt cookie auth_token
        EncryptCookies::except('auth_token');

        // Default meta untuk semua view
        View::share('meta', [
            'show_navbar' => true,
            'show_footer' => true,
        ]);
    }
}
