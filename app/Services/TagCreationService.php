<?php

namespace App\Services;

use App\Interfaces\TagCreationInteface;
use App\Models\Post;
use App\Models\Tag;

class TagCreationService implements TagCreationInteface
{
    private $tags;

    public function set_tags(string $tags_request): void
    {
        $temp = str_replace(' ', '', $tags_request);
        $this->tags = explode('#', $temp);
    }

    public function get_tags()
    {
        return $this->tags;
    }

    public function create_tags_db(Post $post): void
    {
        foreach ($this->get_tags() as $tag) {
            $tag = Tag::firstOrCreate([
                'name' => '#' . $tag
            ]);

            $post->tags()->attach($tag);

        }
    }


}

