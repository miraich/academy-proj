<article class="search__post post post-link">
    @include('components.post-feed-author')
    <div class="post__main">
        <h2><a href="{{route('show_post',$post->id)}}">{{$post->title}}</a></h2>
        <div class="post-link__wrapper">
            <a class="post-link__external" href="{{$post->link}}"
               title="Перейти по ссылке">
                <div class="post-link__icon-wrapper">
                    <img src="{{'storage/previews/'.$post->img}}" alt="Иконка">
                </div>
                <div class="post-link__info">
                    <h3>Ссылка</h3>
                    {{--                    <p>Семейная стоматология в Адлере</p>--}}
                    <span>{{$post->link}}</span>
                </div>
                <img src="{{asset('img/icon-arrow-right-ad.svg')}}" class="post-link__arrow" width="11" height="16">
            </a>
        </div>
    </div>
    @include('components.post-details-indicators')
    @include('components.post-tags')
</article>
