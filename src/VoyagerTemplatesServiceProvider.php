<?php

namespace akazorg\VoyagerTemplates;

use Illuminate\Events\Dispatcher;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class VoyagerTemplatesServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // Load views
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'voyager-templates');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $router->get('test', function () {
            return 'VoyagerTemplatesServiceProvider';
        });
    }


    public function addRoutes(Router $router)
    {
        $router->get('templates', [
            'uses' => '\\'.Controllers\VoyagerTemplatesController::class.'@index',
            'as'   => 'templates',
        ]);
    }
}
