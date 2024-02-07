<?php

namespace App\Providers;

use App\Interfaces\PostInterface;
use App\Services\DownloadFileService;
use App\Services\PostCreationService;
use App\Services\TagCreationService;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class PostServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $fileService = DownloadFileService::class;
        $tagService = TagCreationService::class;

        $this->app->bind(PostInterface::class, function () use ($fileService, $tagService) {
            return new PostCreationService(new $fileService, new $tagService, $this->app->make('ThumbnailRepositoryInstance'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
