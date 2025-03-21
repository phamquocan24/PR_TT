<?php

namespace Modules\Option\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Option\Http\ViewComposers\OptionEditPageComposer;
use Modules\Option\Http\ViewComposers\OptionCreatePageComposer;

class OptionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        View::composer('option::admin.options.create', OptionCreatePageComposer::class);
        View::composer('option::admin.options.edit', OptionEditPageComposer::class);
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {

    }
}
