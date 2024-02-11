<article class="search__post post post-quote">
    @include('components.post-feed-author')
    <div class="post__main">
        <h2><a href="{{route('show_post',$post->id)}}">{{$post->title}}</a></h2>
        <blockquote>
            <p>
                {{$post->content}}
            </p>
            <cite>{{$post->quote_author}}</cite>
        </blockquote>
    </div>
    @include('components.post-details-indicators')
    @include('components.post-tags')
</article>
