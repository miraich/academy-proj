<?php

namespace App\Actions;

use App\Enums\CategoryEnum;
use App\Models\Post;
use Illuminate\Http\Request;

class SortingPopularAction
{
    public function handle(Request $request)
    {
        switch ($request->category) {
            case 'popular': //заглушка
            case 'all':
                return Post::with(['user', 'tags'])
                    ->where('user_id', '!=', auth()->user()->id)
                    ->orderByDesc('created_at')
                    ->simplePaginate(6)
                    ->withQueryString();

            case 'photo':
                return Post::with(['user', 'tags',])
                    ->where('category', CategoryEnum::PHOTO->value)
                    ->where('user_id', '!=', auth()->user()->id)
                    ->orderByDesc('created_at')
                    ->simplePaginate(6)
                    ->withQueryString();

            case 'video':
                return Post::with(['user', 'tags',])
                    ->where('category', CategoryEnum::VIDEO->value)
                    ->where('user_id', '!=', auth()->user()->id)
                    ->orderByDesc('created_at')
                    ->simplePaginate(6)
                    ->withQueryString();

            case 'text':
                return Post::with(['user', 'tags',])
                    ->where('category', CategoryEnum::TEXT->value)
                    ->where('user_id', '!=', auth()->user()->id)
                    ->orderByDesc('created_at')
                    ->simplePaginate(6)
                    ->withQueryString();

            case 'quote':
                return Post::with(['user', 'tags',])
                    ->where('category', CategoryEnum::QUOTE->value)
                    ->where('user_id', '!=', auth()->user()->id)
                    ->orderByDesc('created_at')
                    ->simplePaginate(6)
                    ->withQueryString();

            case 'link':
                return Post::with(['user', 'tags',])
                    ->where('category', CategoryEnum::LINK->value)
                    ->where('user_id', '!=', auth()->user()->id)
                    ->orderBy('created_at', 'desc')
                    ->simplePaginate(6)
                    ->withQueryString();

            case 'likes':
                return Post::with(['user', 'tags',])->withCount('likes')
                    ->where('user_id', '!=', auth()->user()->id)
                    ->orderByDesc('likes_count')
                    ->orderByDesc('created_at')
                    ->simplePaginate(6)
                    ->withQueryString();

            case 'date':
                return Post::with(['user', 'tags',])
                    ->where('user_id', '!=', auth()->user()->id)
                    ->orderBy('created_at', 'asc')
                    ->simplePaginate(6)
                    ->withQueryString();
            default:
                return Post::with(['user', 'tags'])
                    ->where('user_id', '!=', auth()->user()->id)
                    ->orderByDesc('created_at')
                    ->simplePaginate(6)
                    ->withQueryString();
        }
    }
}
