<?php

namespace App\Interfaces;

use App\Http\Requests\PostLinkRequest;
use App\Http\Requests\PostPhotoRequest;
use App\Http\Requests\PostQuoteRequest;
use App\Http\Requests\PostTextRequest;
use App\Http\Requests\PostVideoRequest;

interface PostInterface
{
    public function handle(PostPhotoRequest|PostVideoRequest|PostTextRequest|PostQuoteRequest|PostLinkRequest $request);
}
