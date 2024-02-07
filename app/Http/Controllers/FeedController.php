<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    function index()
    {
        return view('feed');
    }

    function popular()
    {
        return view('popular', [
            'posts' => Post::with('user')
                ->where('user_id', '!=', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->paginate(6)
        ]);
    }
}
