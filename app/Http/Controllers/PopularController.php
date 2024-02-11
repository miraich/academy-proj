<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PopularController extends Controller
{
    function index()
    {
        return view('popular', [
            'posts' => Post::with(['user', 'tags',])
                ->where('user_id', '!=', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->paginate(6)
        ]);
    }
}
