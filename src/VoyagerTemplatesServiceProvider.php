<?php

namespace akazorg\VoyagerTemplates;

use akazorg\VoyagerTemplates\Models\Templates as VoyagerTemplates;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Facades\Voyager as VoyagerFacade;

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

        // Add Routes
        $events->listen('voyager.admin.routing', function ($aaa) {
            $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');
        });

        // Load Views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'voyager');


        // Load Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');


        // Install if table not found
        if (!Schema::hasTable('voyager_templates')) {
            Artisan::call('vendor:publish', [
                '--provider'=> 'akazorg\VoyagerTemplates\VoyagerTemplatesServiceProvider',
                '--force' => true,
            ]);
            Artisan::call('migrate');
            Artisan::call('db:seed', [
                '--class' => 'VoyagerTemplatesTableSeeder',
                '--force' => true,
            ]);
        }
    }


    /**
     * Register the publishable files.
     */
    private function registerPublishableResources()
    {
        $_path = __DIR__.'/..';

        $publishable = [
            'views' => [
                "{$_path}/resources/views/" => resource_path('views/vendor/voyager'),
            ],
            'migrations' => [
                "{$_path}/database/migrations/" => database_path('migrations'),
            ],
            'seeds' => [
                "{$_path}/database/seeds/" => database_path('seeds'),
            ],
            'lang' => [
                "{$_path}/resources/lang/" => base_path('resources/lang/'),
            ],
        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }
}
