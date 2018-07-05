<?php
namespace RentalManager\Utilities;

use Illuminate\Support\ServiceProvider;

/**
 * Created by PhpStorm.
 * Date: 7/3/18
 * Time: 4:01 PM
 * UtilitiesServiceProvider.php
 * @author Goran Krgovic <goran@dashlocal.com>
 */

class UtilitiesServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        'Migration' => 'command.utilities.migration',
        'MakeUtility' => 'command.utilities.utility',
        'SetupModels' => 'command.utilities.setup-models',
        'Setup' => 'command.utilities.setup',
        'Seeder' => 'command.utilities.seeder',
        'AddUtilableTrait' => 'command.utilities.add-utilable-trait'
    ];


    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Merge config file for the current app
        $this->mergeConfigFrom(__DIR__.'/../config/utilities.php', 'utilities');

        // Publish the config files
        $this->publishes([
            __DIR__.'/../config/utilities.php' => config_path('utilities.php'),
            __DIR__.'/../config/utilities_seeder.php' => config_path('utilities_seeder.php')
        ], 'utilities');
    }


    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // Register the app
        $this->registerApp();

        // Register Commands
        $this->registerCommands();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerApp()
    {
        $this->app->bind('utilities', function ($app) {
            return new Utilities($app);
        });

        $this->app->alias('utilities', 'RentalManager\Utilities');
    }

    /**
     * Register the given commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        foreach (array_keys($this->commands) as $command) {
            $method = "register{$command}Command";
            call_user_func_array([$this, $method], []);
        }
        $this->commands(array_values($this->commands));
    }

    protected function registerMigrationCommand()
    {
        $this->app->singleton('command.utilities.migration', function () {
            return new \RentalManager\Utilities\Commands\MigrationCommand();
        });
    }

    protected function registerSeederCommand()
    {
        $this->app->singleton('command.utilities.seeder', function () {
            return new \RentalManager\Utilities\Commands\SeederCommand();
        });
    }

    protected function registerSetupCommand()
    {
        $this->app->singleton('command.utilities.setup', function () {
            return new \RentalManager\Utilities\Commands\SetupCommand();
        });
    }

    protected function registerSetupModelsCommand()
    {
        $this->app->singleton('command.utilities.setup-models', function () {
            return new \RentalManager\Utilities\Commands\SetupModelsCommand();
        });
    }

    protected function registerMakeUtilityCommand()
    {
        $this->app->singleton('command.utilities.utility', function ($app) {
            return new \RentalManager\Utilities\Commands\MakeUtilityCommand($app['files']);
        });
    }


    protected function registerAddUtilableTraitCommand()
    {
        $this->app->singleton('command.utilities.add-utilable-trait', function () {
            return new \RentalManager\Utilities\Commands\AddUtilableTraitCommand();
        });
    }

    /**
     * Get the services provided.
     *
     * @return array
     */
    public function provides()
    {
        return array_values($this->commands);
    }

}