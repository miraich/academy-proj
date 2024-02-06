<?php

namespace App\Services;

use App\Interfaces\ThumbnailRepository;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\HttpFactory;
use Illuminate\Support\Facades\Storage;

class ThumbnailService implements ThumbnailRepository
{
    public string $preview_path;

    public function __construct(private readonly \Psr\Http\Client\ClientInterface $httpClient,
                                private readonly \Mimey\MimeTypes                 $mimes)
    {
    }

    public function get_link_preview(string $url)
    {
        $response = $this->httpClient->sendRequest($this->create_request($url));

        $name = md5(time());
        $extension = $this->mimes->getExtension($response->getHeaderLine('Content-Type')); //Библиотека для получения расширения файла из headers Content-Type
        $this->preview_path = $name . "." . $extension;

        Storage::put('/previews/' . $name . "." . $extension, $response->getBody()->getContents());

    }

    /**
     * @throws GuzzleException
     */
    public function create_request(string $url): \Psr\Http\Message\RequestInterface
    {
        $api_key = "ab478b0d5c3018a34bf552881f3154d27cb8496e8207";
        $link = $url;

        $origin = "https://api.thumbnail.ws/api/$api_key/thumbnail/get?url=" . urlencode($link) . "&width=640";

        return (new HttpFactory())->createRequest("get", $origin);

    }
}

