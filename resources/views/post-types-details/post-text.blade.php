<div class="post-details__wrapper post-text">
    <div class="post-details__main-block post post--details">
        <div class="post__main">
{{--            <h2><a href="#">{{$post->title}}</a></h2>--}}
            <p>
                {{$post->content}}
            </p>
            <a class="post-text__more-link" href="#">Читать далее</a>
        </div>
        @include('components.post-details-indicators')
        @include('components.post-tags')
        @include('components.post-details-comments')
    </div>
    @if(auth()->user()->id!==$post->user_id)
        @include('components.post-details-user-block')
    @endif
</div>
