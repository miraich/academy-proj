<?php

namespace App\Providers;

use App\Interfaces\ThumbnailRepository;
use App\Services\ThumbnailService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Mimey\MimeTypes;

class ThumbnailServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     */
    public function register(): void
    {
        $client = Client::class;
        $mimes = MimeTypes::class;


        $this->app->bind(ThumbnailRepository::class, function () use ($client, $mimes) {
            return new ThumbnailService(new $client, new $mimes);
        });

        $this->app->instance('ThumbnailRepositoryInstance', new ThumbnailService(new $client, new $mimes));

    }


    public function boot(): void
    {


    }
}
