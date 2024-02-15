<?php

namespace App\Actions;

use App\Interfaces\TagCreationInteface;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SearchByTagOrContentAction
{
    public function handle(Request $request, TagCreationInteface $service)
    {
        $search_content = $request->search_content;
        if (isset($search_content) && $search_content !== '') {
            if (str_starts_with($search_content, '#')) {
                $service->set_tags($search_content);
                $tags = $service->get_tags();
                $tags = Tag::whereIn('name', $tags)->with(['posts'])->get();
                if (!$tags->isEmpty()) {
                    foreach ($tags as $tag) {
                        foreach ($tag->posts as $post) {
                            $posts[] = $post;
                        }
                    }
                    return $posts;
                }
            }
            return Post::search($search_content)->get();
        }

    }
}
