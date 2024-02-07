<div class="post-details__wrapper post-quote">
    <div class="post-details__main-block post post--details">
        <div class="post__main">
            <blockquote>
                <p>
                    {{$post->content}}
                </p>
                <cite>{{$post->quote_author}}</cite>
            </blockquote>
        </div>
        @include('components.post-details-indicators')
        @include('components.post-details-comments')
    </div>
    @if(auth()->user()->id!==$post->author)
        @include('components.post-details-user-block')
    @endif
</div>
