<?php

namespace App\Http\Controllers;

use App\Actions\SortingPopularAction;
use App\Actions\SearchByTagOrContentAction;
use App\Interfaces\TagCreationInteface;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search_by_category(Request $request, SortingPopularAction $action)
    {
        $posts = $action->handle($request);

        return view('feed', ['posts' => $posts]);
    }

    public function search_by_tag_or_content(Request $request, SearchByTagOrContentAction $action,
                                             TagCreationInteface $service)
    {
        $posts = $action->handle($request, $service);
//        dd($posts);

        return view('search-results', ['posts' => $posts]);
    }
}
