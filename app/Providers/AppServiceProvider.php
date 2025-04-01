<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Thêm dòng này để đăng ký trực tiếp namespace 'admin'
        $this->loadTranslationsFrom(base_path('modules/Admin/Resources/lang'), 'admin');
    }
}
