<?php

namespace akazorg\VoyagerTemplates;

use Illuminate\Events\Dispatcher;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Facades\Artisan;

class VoyagerTemplatesServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // Publish Migrations
        $this->publishes([
            dirname(__DIR__).'/database/migrations' => database_path('migrations')
        ], 'migrations');

        // Load views
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'voyager-templates');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        // Load migrations
        // $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        // Artisan::call('migrate');

        /**
         * Add Routes
         */
        $events->listen('voyager.admin.routing', [$this, 'addRoutes']);
    }


    public function addRoutes(Router $router)
    {
        $namespacePrefix = '\\akazorg\\voyagerTemplates\\Http\\Controllers\\';
        $router->resource('voyager-templates', $namespacePrefix.'VoyagerTemplatesController');
    }
}
