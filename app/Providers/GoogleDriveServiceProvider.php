<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Masbug\Flysystem\GoogleDrive\Client;
use Masbug\Flysystem\GoogleDrive\Drive; 
use Masbug\Flysystem\GoogleDrive\GoogleDriveAdapter; 
use League\Flysystem\Filesystem; 
use League\Flysystem\FilesystemAdapter; 

class GoogleDriveServiceProvider extends ServiceProvider
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
        Storage::extend('google', function ($app, $config) {
            $client = new Client(); // Create a Client instance
            $client->setClientId($config['clientId']);
            $client->setClientSecret($config['clientSecret']);
            $client->refreshToken($config['refreshToken']);

            $service = new Drive($client); // Create a Drive instance
            $adapter = new GoogleDriveAdapter($service, $config['folder'] ?? '/', $options ?? []); // Use default options if not provided

            $driver = new Filesystem($adapter); // Create a Filesystem instance
            return new FilesystemAdapter($driver, $adapter); // Create a FilesystemAdapter instance
        });
    }
}
