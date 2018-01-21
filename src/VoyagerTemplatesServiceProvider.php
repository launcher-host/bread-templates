<?php

namespace VoyagerTemplates;

use Illuminate\Events\Dispatcher;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen('voyager.admin.routing', function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');
        });

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'templates');

        (new TemplatesManager())->registerTemplateHandler();
    }
}
