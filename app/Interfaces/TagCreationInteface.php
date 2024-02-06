<?php

namespace App\Interfaces;

use App\Models\Post;

interface TagCreationInteface
{
    public function create_tags_db(Post $post): void;
}
