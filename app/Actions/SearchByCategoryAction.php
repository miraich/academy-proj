<?php

namespace App\Actions;

use App\Enums\CategoryEnum;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchByCategoryAction
{
    public function handle(Request $request)
    {
        switch ($request->category) {
            case "all":

            case "photo":
                return Post::where('category', CategoryEnum::PHOTO->value);

//            default: тоже all
        }
    }
}
