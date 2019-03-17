<?php
/**
 * File ServiceProvider.php
 *
 * @author Tuan Duong <bacduong@gmail.com>
 * @package Laravue
 * @version 1.0
 */
namespace Tuandm\Laravue;

use Tuandm\Laravue\Console\LaravueCommand;

/**
 * Class LaravueServiceProvider
 *
 * @package App\Providers
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPackages();
        $this->registerMigrations();
        $this->registerViews();
        $this->registerRoutes();
        $this->registerCommands();
    }

    /**
     * Register all necessary resources/assets for Laravue
     */
    protected function registerPackages()
    {
        $this->publishes([
            __DIR__ . '/config/laravue.php' => config_path('laravue.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/resources/js' => resource_path('vendor/laravue')
        ], 'laravue-core');
        $this->publishes([
             __DIR__ . '/public/static' => public_path('static'),
             __DIR__ . '/public/css/fonts' => public_path('css/fonts'),
        ], 'laravue-asset');
    }

    /**
     * Load Laravue view file
     */
    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'laravue');
    }

    /**
     * Migrations for Laravue core
     * Laravue requires simple role in users table, you have to custom Laravue package/your code to make them work together
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations/');
    }

    /**
     * Register basic routes for Laravue core
     */
    protected function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/laravue.php');
    }

    /**
     * Laravue commands
     */
    protected function registerCommands()
    {
        $this->commands([
            LaravueCommand::class,
        ]);
    }
}
