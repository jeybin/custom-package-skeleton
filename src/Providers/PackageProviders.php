<?php

namespace Jeybin\Packagename\Providers;

use Illuminate\Support\ServiceProvider;
use Jeybin\Packagename\Facades\PackageFacades;
use Jeybin\Packagename\Console\PublishProviders;
use Jeybin\Packagename\Console\PublishMigrations;

class PackageProviders extends ServiceProvider
{   

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        /**
         * Autoloading the helper functions
         */
        require_once __DIR__ . '/../App/Helpers/HelperFunctions.php';

        /**
         * Time stamp made as static 
         * to avoid multiple migration files creation
         * with multiple time stamp
         */            
        $timestamp = '2022_10_20_132000';

        $migrationFiles = ['create_package_table'];

        $migrations = [];

        foreach($migrationFiles as $migrationFile){

            /**
             * Path of the migration file of ngenius_gateway inside the composer package
             */
            $package_migration_path =  __DIR__.'/../../database/migrations/'.$migrationFile.'.php.stub';

            /**
             * Migration file of ngenius_gateway path where it need to be copied
             */
            $project_migration_path = database_path("migrations/ngenius/{$timestamp}_{$migrationFile}.php");

            array_push($migrations,[$package_migration_path=>$project_migration_path]);
        }

        /**
         * Publishes the Migrations files
         * with a tag name ngenius can use any tag 
         * name, use the same name while publishing the 
         * vendor 
         */
        $this->publishes($migrations, 'package-migrations');


        /**
         * Config file merging into the project
         */
        
        $configs = [
            __DIR__.'/../../Config/package-config.php' => config_path('package-config.php') 
        ];

        $this->publishes($configs, 'package-config');


        /**
         * Adding the package routes to the project
         * Here we are adding the webhook listener api
         */
        $this->loadRoutesFrom(__DIR__.'/../Routes/packagename-routes.php');


        /**
         * Checking if the app is 
         * running from console
         */
        if ($this->app->runningInConsole()) {

            /**
             * Adding custom commands class to the 
             * service provider
             */
            $this->commands([
                PublishProviders::class,
                PublishMigrations::class,
            ]);
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(){

        $this->mergeConfigFrom(
            __DIR__.'/../../Config/package-config.php', 'package-config'
        );

        
        $this->app->bind('packagefacade',fn($app)=>new PackageFacades($app));

        $this->app->alias('packagefacade', PackageFacades::class);

    }
}