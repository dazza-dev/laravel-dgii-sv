<?php

namespace DazzaDev\LaravelDgiiSv;

use DazzaDev\DgiiSv\Client;
use DazzaDev\LaravelDgiiSv\Commands\DgiiSvInstallCommand;
use Illuminate\Support\ServiceProvider;

class LaravelDgiiSvServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('laravel-dgii-sv', function ($app) {
            $client = new Client(config('laravel-dgii-sv.test'));

            // set credentials
            if (config('laravel-dgii-sv.auth.nit') && config('laravel-dgii-sv.auth.password')) {
                $client->setCredentials([
                    'nit' => config('laravel-dgii-sv.auth.nit'),
                    'password' => config('laravel-dgii-sv.auth.password'),
                ]);
            }

            // Set certificate
            if (config('laravel-dgii-sv.certificate.path') && config('laravel-dgii-sv.certificate.password')) {
                $client->setCertificate([
                    'path' => config('laravel-dgii-sv.certificate.path'),
                    'password' => config('laravel-dgii-sv.certificate.password'),
                ]);
            }

            // Set path
            if (config('laravel-dgii-sv.path')) {
                $client->setFilePath(config('laravel-dgii-sv.path'));
            }

            return $client;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/laravel-dgii-sv.php' => config_path('laravel-dgii-sv.php'),
        ], 'laravel-dgii-sv-config');

        // Migrations
        $this->publishes([
            $this->getMigrationFilePath('create_dgii_configs_table.php') => database_path('migrations/'.$this->getMigrationFileName('create_dgii_configs_table.php')),
            $this->getMigrationFilePath('create_dgii_documents_table.php') => database_path('migrations/'.$this->getMigrationFileName('create_dgii_documents_table.php')),
        ], 'laravel-dgii-sv-migrations');

        // Lang
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-dgii-sv');

        // Commands
        $this->commands([
            DgiiSvInstallCommand::class,
        ]);
    }

    /**
     * Get the migration file path.
     */
    protected function getMigrationFilePath(string $migrationFileName): string
    {
        return __DIR__.'/../database/migrations/'.$migrationFileName;
    }

    /**
     * Get the migration file name with current timestamp.
     */
    protected function getMigrationFileName(string $migrationFileName): ?string
    {
        return date('Y_m_d_His').'_'.$migrationFileName;
    }
}
