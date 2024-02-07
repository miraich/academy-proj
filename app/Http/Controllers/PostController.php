<?php

namespace App\Http\Controllers;

use App\Enums\CategoryEnum;
use App\Http\Requests\PostLinkRequest;
use App\Http\Requests\PostPhotoRequest;
use App\Http\Requests\PostQuoteRequest;
use App\Http\Requests\PostTextRequest;
use App\Http\Requests\PostVideoRequest;
use App\Interfaces\PostInterface;
use App\Interfaces\TagCreationInteface;
use App\Interfaces\ThumbnailRepository;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function show_adding_post_photo()
    {
        return view('adding-post-views.adding-post-photo');
    }

    public function show_adding_post_video()
    {
        return view('adding-post-views.adding-post-video');
    }

    public function show_adding_post_text()
    {
        return view('adding-post-views.adding-post-text');
    }

    public function show_adding_post_quote()
    {
        return view('adding-post-views.adding-post-quote');
    }

    public function show_adding_post_link()
    {
        return view('adding-post-views.adding-post-link');
    }

    public function show(Post $post)
    {
        return view('post', ['post' => $post]);
    }

    public function create_post_photo(PostPhotoRequest $request, PostInterface $postCreationService)
    {

        $postCreationService->handle($request);

        return redirect(route('show_post', $postCreationService->postId));

    }

    public function create_post_video(PostVideoRequest $request, PostInterface $postCreationService)
    {
        $postCreationService->handle($request);

        return redirect(route('show_post', $postCreationService->postId));
    }

    public function create_post_text(PostTextRequest $request, PostInterface $postCreationService)
    {
        $postCreationService->handle($request);

        return redirect(route('show_post', $postCreationService->postId));
    }

    public function create_post_quote(PostQuoteRequest $request, PostInterface $postCreationService)
    {
        $postCreationService->handle($request);

        return redirect(route('show_post', $postCreationService->postId));
    }

    public function create_post_link(PostLinkRequest $request, PostInterface $postCreationService)
    {
        $postCreationService->handle($request);

        return redirect(route('show_post', $postCreationService->postId));
    }
}
