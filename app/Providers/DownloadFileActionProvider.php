<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DownloadFileActionProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
//        $this->app->bind(UploadedFile::class, function (Application $app) {
//            return new DownloadFileActionProvider($app->make(DownloadFileService::class));
//        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
