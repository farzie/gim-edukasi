<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;

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
        // Pengecekan jika aplikasi sedang berjalan di lingkungan produksi atau melalui Ngrok/Proxy.
        // Ngrok menambahkan header 'HTTP_X_FORWARDED_PROTO' atau 'X-Forwarded-Proto'
        if (env('APP_ENV') === 'production' || str_contains(env('APP_URL'), 'ngrok') || $this->app->environment('production')) {
             // Beri tahu Laravel untuk menghasilkan URL menggunakan HTTPS
            URL::forceScheme('https');
        }
    }
}
