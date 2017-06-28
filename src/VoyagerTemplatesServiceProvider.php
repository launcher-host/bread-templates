<?php

namespace akazorg\VoyagerTemplates;

use akazorg\VoyagerTemplates\Models\Templates as VoyagerTemplates;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

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

        $events->listen('voyager.admin.routing', [$this, 'addRoutes']);

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if (!Schema::hasTable('voyager_templates')) {
            Artisan::call('vendor:publish');
            Artisan::call('migrate');
            Artisan::call('db:seed', [
                '--class' => 'VoyagerTemplatesTableSeeder',
                '--force' => true,
            ]);
        }
    }

    /**
     * Add Routes
     */
    public function addRoutes()
    {
        $hookController = '\\akazorg\\VoyagerTemplates\\Http\\Controllers\\VoyagerTemplatesController';

        Route::resource('templates', $hookController);

        Route::get('templates/create/', ['uses' => $hookController.'@create__', 'as' => 'templates.create']);
    }


    /**
     * Register the publishable files.
     */
    private function registerPublishableResources()
    {
        $_path = __DIR__.'/..';

        $publishable = [
            // 'voyager_assets' => [
                // "{$_path}/resources/assets/" => base_path('resources/assets/'),
            // ],
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
