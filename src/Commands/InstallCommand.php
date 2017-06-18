<?php

namespace akazorg\VoyagerTemplates\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use akazorg\VoyagerTemplates\VoyagerTemplatesServiceProvider;

class InstallCommand extends Command
{
    protected $seedersPath = __DIR__.'/../../database/migrations/';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'voyager-templates:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the hook Voyager Templates';


    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd().'/composer.phar')) {
            return '"'.PHP_BINARY.'" '.getcwd().'/composer.phar';
        }

        return 'composer';
    }

    /**
     * Execute the console command.
     *
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     *
     * @return void
     */
    public function fire(Filesystem $filesystem)
    {
        $this->info('Publishing the Voyager assets, database, and config files');
        $this->call('vendor:publish', ['--provider' => VoyagerTemplatesServiceProvider::class]);

        $this->info('Migrating the database tables into your application');
        $this->call('migrate');

        $this->info('Dumping the autoloaded files and reloading all new files');

        $composer = $this->findComposer();

        $process = new Process($composer.' dump-autoload');
        $process->setWorkingDirectory(base_path())->run();

        $this->info('Adding Voyager routes to routes/web.php');
        $filesystem->append(
            base_path('routes/web.php'),
            "\n\nRoute::group(['prefix' => 'admin'], function () {\n    Voyager::routes();\n});\n"
        );

        \Route::group(['prefix' => 'admin'], function () {
            \Voyager::routes();
        });

        $this->info('Successfully installed Voyager! Enjoy 🎉');
    }
}
