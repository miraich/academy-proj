<article class="search__post post post-text">
    @include('components.post-feed-author')
    <div class="post__main">
        <h2><a href="{{route('show_post',$post->id)}}">{{$post->title}}</a></h2>
        <p>
            {{$post->content}}
        </p>
        {{--        <a class="post-text__more-link" href="#">Читать далее</a>--}}
    </div>
    @include('components.post-details-indicators')
    @include('components.post-tags')
</article>


