<?php

namespace App\Services;

use App\Actions\NotifySubscribedAction;
use App\Enums\CategoryEnum;
use App\Http\Requests\PostLinkRequest;
use App\Http\Requests\PostPhotoRequest;
use App\Http\Requests\PostQuoteRequest;
use App\Http\Requests\PostTextRequest;
use App\Http\Requests\PostVideoRequest;
use App\Interfaces\DownloadFileInterface;
use App\Interfaces\PostInterface;
use App\Interfaces\TagCreationInteface;
use App\Interfaces\ThumbnailRepository;
use App\Jobs\Mail;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostCreationService implements PostInterface
{

    public int $postId;

    public function __construct(private readonly DownloadFileInterface  $fileService,
                                private readonly TagCreationInteface    $tagService,
                                private readonly ThumbnailRepository    $thumbnailService,
                                private readonly NotifySubscribedAction $notifySubscribedAction)
    {

    }

    public function handle(PostPhotoRequest|PostVideoRequest|PostTextRequest|PostQuoteRequest|PostLinkRequest $request)
    {
        switch ($request) {
            case $request instanceof PostPhotoRequest:
                if ($request->has(['link', 'userpic-file-photo'])) {
                    $request->except('link');
                    $this->fileService->download_file_form($request->file('userpic-file-photo'), 'post_photo');
                }

                $this->fileService->download_file_by_url($request->link, 'post_photo');

                $post = Post::create([
                    'category' => CategoryEnum::PHOTO->value,
                    'user_id' => Auth::user()->id,
                    'title' => $request->photo_heading,
                    'img' => $this->fileService->get_filename() . '.' . $this->fileService->get_ext(),
                ]);

                $this->tagService->set_tags($request->input('tags'));
                $this->tagService->create_tags_db($post);
                $this->postId = $post->id;

                $this->notifySubscribedAction->handle($post);
                break;

            case $request instanceof PostVideoRequest:
                $post = Post::create([
                    'category' => CategoryEnum::VIDEO->value,
                    'user_id' => Auth::user()->id,
                    'title' => $request->video_heading,
                    'video' => $request->video_link
                ]);

                $this->tagService->set_tags($request->input('tags'));
                $this->tagService->create_tags_db($post);
                $this->postId = $post->id;

                $this->notifySubscribedAction->handle($post);

                break;

            case $request instanceof PostTextRequest:
                $post = Post::create([
                    'category' => CategoryEnum::TEXT->value,
                    'user_id' => Auth::user()->id,
                    'title' => $request->text_heading,
                    'content' => $request->description,
                ]);

                $this->tagService->set_tags($request->input('tags'));
                $this->tagService->create_tags_db($post);
                $this->postId = $post->id;

                $this->notifySubscribedAction->handle($post);

                break;

            case $request instanceof PostQuoteRequest:
                $post = Post::create([
                    'category' => CategoryEnum::QUOTE->value,
                    'user_id' => Auth::user()->id,
                    'title' => $request->quote_heading,
                    'content' => $request->quote_text,
                    'quote_author' => $request->quote_author,
                ]);

                $this->tagService->set_tags($request->input('tags'));
                $this->tagService->create_tags_db($post);
                $this->postId = $post->id;

                $this->notifySubscribedAction->handle($post);

                break;

            case $request instanceof PostLinkRequest:
                $post = Post::create([
                    'category' => CategoryEnum::LINK->value,
                    'user_id' => Auth::user()->id,
                    'title' => $request->link_heading,
                    'link' => $request->post_link,
                ]);

                $this->tagService->set_tags($request->input('tags'));
                $this->tagService->create_tags_db($post);
                $this->thumbnailService->get_link_preview($request->post_link);
                $post->update([
                    'img' => $this->thumbnailService->preview_path
                ]);
                $this->postId = $post->id;

                $this->notifySubscribedAction->handle($post);

                break;
        }
    }
}
