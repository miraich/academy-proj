<?php

namespace App\Providers;

use App\Interfaces\DownloadFileInterface;
use App\Interfaces\PostInterface;
use App\Interfaces\TagCreationInteface;
use App\Services\DownloadFileService;
use App\Services\PostCreationService;
use App\Services\TagCreationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        DownloadFileInterface::class => DownloadFileService::class,
        TagCreationInteface::class => TagCreationService::class,
        PostInterface::class => PostCreationService::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
