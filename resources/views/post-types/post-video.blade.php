<div class="post-details__wrapper post-video">
    <div class="post-details__main-block post post--details">
        <div class="post-video__block">
            <div class="post-video__preview">
                <img src="{{asset('img/coast.jpg')}}" alt="Превью к видео" width="760" height="396">
            </div>
            <div class="post-video__control">
                <button class="post-video__play post-video__play--paused button button--video"
                        type="button"><span class="visually-hidden">Запустить видео</span>
                </button>
                <div class="post-video__scale-wrapper">
                    <div class="post-video__scale">
                        <div class="post-video__bar">
                            <div class="post-video__toggle"></div>
                        </div>
                    </div>
                </div>
                <button
                    class="post-video__fullscreen post-video__fullscreen--inactive button button--video"
                    type="button"><span class="visually-hidden">Полноэкранный режим</span>
                </button>
            </div>
            <button class="post-video__play-big button" type="button">
                <img src="{{asset('img/icon-video-play-big.svg')}}" class="post-video__play-big-icon" width="27"
                     height="28">
                <span class="visually-hidden">Запустить проигрыватель</span>
            </button>
        </div>
        @include('components.post-details-indicators')
        @include('components.post-details-comments')
    </div>
    @include('components.post-details-user-block')
</div>
