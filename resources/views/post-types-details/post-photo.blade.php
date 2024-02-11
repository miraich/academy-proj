<div class="post-details__wrapper post-photo">
    <div class="post-details__main-block post post--details">
        <div class="post-details__image-wrapper post-photo__image-wrapper">
            <img src="{{asset('storage/post_photo/'.$post->img)}}" alt="Фото от пользователя"
                 width="760" height="507">
        </div>
        @include('components.post-details-indicators')
        @include('components.post-tags')
        @include('components.post-details-comments')
    </div>
    @if(auth()->user()->id!==$post->author)
        @include('components.post-details-user-block')
    @endif
</div>
