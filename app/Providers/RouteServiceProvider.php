<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Make sure there's no middleware being applied here that could affect admin routes
        $this->routes(function () {
            Route::middleware('web')  // Only web middleware, no auth
                ->group(base_path('routes/web.php'));
            // ...
        });
    }
} 