<article class="search__post post post-photo">
@include('components.post-feed-author')
    <div class="post__main">
        <h2><a href="{{route('show_post',$post->id)}}">{{$post->title}}</a></h2>
        <div class="post-photo__image-wrapper">
            <img src="{{asset('storage/post_photo/'.$post->img)}}" alt="Фото от пользователя" width="760" height="396">
        </div>
    </div>
    @include('components.post-details-indicators')
    @include('components.post-tags')
</article>
