<?php

namespace akazorg\VoyagerTemplates;

use akazorg\VoyagerTemplates\Providers\HookEventsServiceProvider;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
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
        // $this->app->singleton('template', function (Container $app) {
        //     return new TemplatesManager($app);
        // });
        // $this->app->alias('template', TemplatesManager::class);

        $this->app->register(HookEventsServiceProvider::class);
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

        (new TemplatesManager())->registerTemplateHandler();
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
                '--provider' => 'akazorg\VoyagerTemplates\VoyagerTemplatesServiceProvider',
                '--force'    => true,
            ]);
            Artisan::call('migrate');
            Artisan::call('db:seed', [
                '--class' => 'DatabaseSeeder',
                '--force' => true,
            ]);
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
