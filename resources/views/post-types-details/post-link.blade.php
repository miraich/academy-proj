<div class="post-details__wrapper post-link">
    <div class="post-details__main-block post post--details">
        <div class="post__main">
            <div class="post-link__wrapper">
                <a class="post-link__external" href="{{$post->link}}"
                   title="Перейти по ссылке">
                    <div class="post-link__icon-wrapper">
                        <img src="{{asset('storage/previews/'.$post->img)}}" alt="Иконка">
                    </div>
                    <div class="post-link__info">
                        <h3>Ссылка</h3>
                        <span>{{$post->link}}</span>
                    </div>
                    <img class="post-link__arrow" width="11" height="16" src="{{asset('img/icon-arrow-right-ad.svg')}}">
                </a>
            </div>
        </div>
        @include('components.post-details-indicators')
        @include('components.post-tags')
        @include('components.post-details-comments')
    </div>
    @if(auth()->user()->id!==$post->author)
        @include('components.post-details-user-block')
    @endif
</div>
