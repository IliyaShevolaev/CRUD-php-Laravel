<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            if (auth()->check()) {
                $view->with([
                    'isAdminView' => auth()->user()->role === 'admin',
                    'adminLteLayout' => auth()->user()->role === 'admin' ? 'components.admin-layout' : 'components.main'
                ]);
            }
        });
    }
}
