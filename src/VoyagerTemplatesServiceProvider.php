<?php

namespace akazorg\VoyagerTemplates;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use TCG\Voyager\Facades\Voyager;

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
        $this->registerPublishableResources();

        $events->listen('voyager.admin.routing', function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');
        });

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'templates');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->setupHook();

        (new TemplatesManager)->registerTemplateHandler();
    }

    /**
     * Setup the Hook.
     *
     * @return void
     */
    private function setupHook()
    {
        // Install if table not found
        if (!Schema::hasTable('voyager_templates')) {
            Artisan::call('vendor:publish', [
                '--provider'=> 'akazorg\VoyagerTemplates\VoyagerTemplatesServiceProvider',
                '--force' => true,
            ]);
            Artisan::call('migrate');
            Artisan::call('db:seed', [
                '--class' => 'DatabaseSeeder',
                '--force' => true,
            ]);
        }

        // Make sure we have a folder for saving template files
        $path = resource_path('views/vendor/voyager/templates');
        if(! File::exists($path)) {
            File::makeDirectory($path, 0775, true);
        }
    }

    /**
     * Register the publishable files.
     *
     * @return void
     */
    protected function registerPublishableResources()
    {
        $_path = __DIR__.'/..';

        $publishable = [
            // we can publish views, but I would like to overwrite/reload voyager views
            // ----------------------------------------------------------------------------
            // 'views' => [
            //     "{$_path}/resources/views/" => resource_path('views/vendor/voyager'),
            // ],
            'migrations' => [
                "{$_path}/database/migrations/" => database_path('migrations'),
            ],
            'seeds' => [
                "{$_path}/database/seeds/" => database_path('seeds'),
            ],
        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }
}
