<?php

namespace App\Interfaces;

interface ThumbnailRepository
{
    public function get_link_preview(string $url);
}
