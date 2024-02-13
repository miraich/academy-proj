<?php

namespace App\Http\Controllers;

use App\Actions\SortingPopularAction;
use App\Models\Post;
use Illuminate\Http\Request;

class PopularController extends Controller
{
    function index(Request $request, SortingPopularAction $action)
    {
        $posts = $action->handle($request);

        return view('popular', [
            'posts' => $posts
        ]);
    }
}
