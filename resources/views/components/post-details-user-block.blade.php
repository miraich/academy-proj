<div class="post-details__user user">
    <div class="post-details__user-info user__info">
        <div class="post-details__avatar user__avatar">
            <a class="post-details__avatar-link user__avatar-link" href="{{route('profile',$post->user->id)}}">
                <img class="post-details__picture user__picture"
                     src="{{asset("storage/avatars/".$post->user->avatar)}}"
                     alt="Аватар пользователя">
            </a>
        </div>
        <div class="post-details__name-wrapper user__name-wrapper">
            <a class="post-details__name user__name" href="{{route('profile',$post->user->id)}}">
                <span>{{$post->user->login}}</span>
            </a>
            <time class="post-details__time user__time" datetime="2014-03-20">5 лет на сайте
            </time>
        </div>
    </div>
    <div class="post-details__rating user__rating">
        <p class="post-details__rating-item user__rating-item user__rating-item--subscribers">
            <span class="post-details__rating-amount user__rating-amount">{{$post->user->get_subscribers_count()}}</span>
            <span class="post-details__rating-text user__rating-text">подписчиков</span>
        </p>
        <p class="post-details__rating-item user__rating-item user__rating-item--publications">
            <span class="post-details__rating-amount user__rating-amount">{{$post->user->get_posts_count()}}</span>
            <span class="post-details__rating-text user__rating-text">публикаций</span>
        </p>
    </div>
    <div class="post-details__user-buttons user__buttons">
        @if(auth()->user()->subscribed_on_author($post->user_id)->exists())
            <form class="post-details__user-buttons" style="padding-bottom: 5px"
                  action="{{route('unsubscribe',$post->user_id)}}" method="post">
                @csrf
                @method('post')
                <button class="user__button user__button--subscription button button--main"
                        type="submit">
                    Отписаться
                </button>
            </form>
        @else
            <form class="post-details__user-buttons" style="padding-bottom: 5px"
                  action="{{route('subscribe',$post->user_id)}}" method="post">
                @csrf
                @method('post')
                <button class="user__button user__button--subscription button button--main"
                        type="submit">
                    Подписаться
                </button>
            </form>
        @endif
        <a class="user__button user__button--writing button button--green"
           href="#">Сообщение</a>
    </div>
</div>

