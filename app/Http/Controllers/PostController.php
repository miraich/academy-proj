<?php

namespace App\Http\Controllers;

use App\Enums\CategoryEnum;
use App\Http\Requests\PostLinkRequest;
use App\Http\Requests\PostPhotoRequest;
use App\Http\Requests\PostQuoteRequest;
use App\Http\Requests\PostTextRequest;
use App\Http\Requests\PostVideoRequest;
use App\Interfaces\DownloadFileInterface;
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

    public function create_post_photo(PostPhotoRequest $request, DownloadFileInterface $fileService, TagCreationInteface $tagService)
    {
        if ($request->has(['link', 'userpic-file-photo'])) {
            $request->except('link');
            $fileService->download_file_form($request->file('userpic-file-photo'), 'post_photo');
        }

        $fileService->download_file_by_url($request->link, 'post_photo');

        $post = Post::create([
            'category' => CategoryEnum::PHOTO->value,
            'author' => Auth::user()->id,
            'title' => $request->photo_heading,
            'img' => $fileService->get_filename() . '.' . $fileService->get_ext(),
        ]);

        $tagService->set_tags($request->input('tags'));
        $tagService->create_tags_db($post);

        return redirect(route('show_post', $post->id));

    }

    public function create_post_video(PostVideoRequest $request, TagCreationInteface $tagService)
    {
        $post = Post::create([
            'category' => CategoryEnum::VIDEO->value,
            'author' => Auth::user()->id,
            'title' => $request->video_heading,
            'video' => $request->video_link
        ]);

        $tagService->set_tags($request->input('tags'));
        $tagService->create_tags_db($post);

        return redirect(route('show_post', $post->id));
    }

    public function create_post_text(PostTextRequest $request, TagCreationInteface $tagService)
    {
        $post = Post::create([
            'category' => CategoryEnum::TEXT->value,
            'author' => Auth::user()->id,
            'title' => $request->text_heading,
            'content' => $request->description,
        ]);

        $tagService->set_tags($request->input('tags'));
        $tagService->create_tags_db($post);

        return redirect(route('show_post', $post->id));
    }

    public function create_post_quote(PostQuoteRequest $request, TagCreationInteface $tagService)
    {
        $post = Post::create([
            'category' => CategoryEnum::QUOTE->value,
            'author' => Auth::user()->id,
            'title' => $request->quote_heading,
            'content' => $request->quote_text,
            'quote_author' => $request->quote_author,
        ]);

        $tagService->set_tags($request->input('tags'));
        $tagService->create_tags_db($post);

        return redirect(route('show_post', $post->id));
    }

    public function create_post_link(PostLinkRequest $request, TagCreationInteface $tagService, ThumbnailRepository $thumbnailService)
    {
        $post = Post::create([
            'category' => CategoryEnum::LINK->value,
            'author' => Auth::user()->id,
            'title' => $request->link_heading,
            'link' => $request->post_link,
        ]);

        $tagService->set_tags($request->input('tags'));
        $tagService->create_tags_db($post);

        $thumbnailService->get_link_preview($request->post_link);

        $post->update([
            'img' => $thumbnailService->preview_path
        ]);

        return redirect(route('show_post', $post->id));
    }
}
