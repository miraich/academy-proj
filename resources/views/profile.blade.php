@extends('layouts.app')

@section('title','readme: профиль')

@section('content')
    <main class="page__main page__main--profile">
        <h1 class="visually-hidden">Профиль</h1>
        <div class="profile profile--default">
            <div class="profile__user-wrapper">
                <div class="profile__user user container">
                    <div class="profile__user-info user__info">
                        <div class="profile__avatar user__avatar">
                            <img class="profile__picture user__picture"
                                 src="{{asset('storage/avatars/'.$user->avatar)}}"
                                 alt="Аватар пользователя">
                        </div>
                        <div class="profile__name-wrapper user__name-wrapper">
                            <span class="profile__name user__name">{{$user->login}}</span>
                            <time class="profile__user-time user__time" datetime="2014-03-20">5 лет на сайте</time>
                        </div>
                    </div>
                    <div class="profile__rating user__rating">
                        <p class="profile__rating-item user__rating-item user__rating-item--publications">
                            <span class="user__rating-amount">{{$user->get_posts_count()}}</span>
                            <span class="profile__rating-text user__rating-text">публикаций</span>
                        </p>
                        <p class="profile__rating-item user__rating-item user__rating-item--subscribers">
                            <span class="user__rating-amount">{{$user->get_subscribers_count()}}</span>
                            <span class="profile__rating-text user__rating-text">подписчиков</span>
                        </p>
                    </div>
                    @if(auth()->user()->id!==$user->id)
                        @if(auth()->user()->subscribed_on_author($user->id)->exists())
                            <form action="{{route('unsubscribe',$user->id)}}"
                                  class="profile__user-buttons user__buttons" method="post">
                                @csrf
                                <button
                                        class="profile__user-button user__button user__button--subscription button button--main"
                                        type="submit">Отписаться
                                </button>
                                <a class="profile__user-button user__button user__button--writing button button--green"
                                   href="#">Сообщение</a>
                            </form>
                        @else
                            <form action="{{route('subscribe',$user->id)}}" method="post"
                                  class="profile__user-buttons user__buttons">
                                @csrf
                                <button
                                        class="profile__user-button user__button user__button--subscription button button--main"
                                        type="submit">Подписаться
                                </button>
                                <a class="profile__user-button user__button user__button--writing button button--green"
                                   href="#">Сообщение</a>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
            <div class="profile__tabs-wrapper tabs">
                <div class="container">
                    <div class="profile__tabs filters">
                        <b class="profile__tabs-caption filters__caption">Показать:</b>
                        <ul class="profile__tabs-list filters__list tabs__list">
                            <li class="profile__tabs-item filters__item">
                                <a href="{{route('profile',$user->id."?show=posts")}}"
                                   class="profile__tabs-link filters__button  tabs__item
                                    @if(request()->input('show')==='posts') filters__button--active @endif  button">Посты</a>
                            </li>
                            <li class="profile__tabs-item filters__item">
                                <a href="{{route('profile',$user->id."?show=likes")}}"
                                   class="profile__tabs-link filters__button tabs__item
                                    @if(request()->input('show')==='likes') filters__button--active @endif button">Лайки</a>
                            </li>
                            <li class="profile__tabs-item filters__item">
                                <a href="{{route('profile',$user->id."?show=subscriptions")}}"
                                   class="profile__tabs-link filters__button
                                    @if(request()->input('show')==='subscriptions') filters__button--active @endif
                                    tabs__item button">Подписки</a>
                            </li>
                        </ul>
                    </div>
                    <div class="profile__tab-content">
                        @if(request()->input('show')==='posts')
                            <section class="profile__posts tabs__content tabs__content--active">
                                <h2 class="visually-hidden">Публикации</h2>
                                @if(!empty($posts))
                                    @foreach($posts as $post)
                                        @switch($post->category)
                                            @case(\App\Enums\CategoryEnum::PHOTO->value)
                                                @include('posts-types-feed.post-photo')
                                                @break
                                            @case(\App\Enums\CategoryEnum::VIDEO->value)
                                                @include('posts-types-feed.post-video')
                                                @break
                                            @case(\App\Enums\CategoryEnum::TEXT->value)
                                                @include('posts-types-feed.post-text')
                                                @break
                                            @case(\App\Enums\CategoryEnum::QUOTE->value)
                                                @include('posts-types-feed.post-quote')
                                                @break
                                            @case(\App\Enums\CategoryEnum::LINK->value)
                                                @include('posts-types-feed.post-link')
                                                @break
                                        @endswitch
                                    @endforeach
                                @endif
                            </section>
                        @endif

                        @if(request()->input('show')==='likes')
                            <section class="profile__likes tabs__content--active">
                                <h2 class="visually-hidden">Лайки</h2>
                                <ul class="profile__likes-list">
                                    @if(!empty($likes))
                                        @foreach($likes as $like)
                                            <li class="post-mini post-mini--photo post user">
                                                <div class="post-mini__user-info user__info">
                                                    <div class="post-mini__avatar user__avatar">
                                                        <a class="user__avatar-link"
                                                           href="{{route('profile',$like->user->id)}}">
                                                            <img class="post-mini__picture user__picture"
                                                                 src="{{asset("storage/avatars/".$like->user->avatar)}}"
                                                                 alt="Аватар пользователя">
                                                        </a>
                                                    </div>
                                                    <div class="post-mini__name-wrapper user__name-wrapper">
                                                        <a class="post-mini__name user__name"
                                                           href="{{route('profile',$like->user->id)}}">
                                                            <span>{{$like->user->login}}</span>
                                                        </a>
                                                        <div class="post-mini__action">
                                                            <span class="post-mini__activity user__additional">Лайкнул вашу публикацию</span>
                                                            <time class="post-mini__time user__additional"
                                                                  datetime="2014-03-20T20:20">{{$like->user->created_at}}
                                                            </time>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                        <div class="post-mini__preview">--}}
                                                {{--                                            <a class="post-mini__link" href="#" title="Перейти на публикацию">--}}
                                                {{--                                                <div class="post-mini__image-wrapper">--}}
                                                {{--                                                    <img class="post-mini__image" src="img/rock-small.png" width="109"--}}
                                                {{--                                                         height="109" alt="Превью публикации">--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <span class="visually-hidden">Фото</span>--}}
                                                {{--                                            </a>--}}
                                                {{--                                        </div>--}}
                                            </li>
                                        @endforeach
                                    @endif
                                    {{--                                    <li class="post-mini post-mini--text post user">--}}
                                    {{--                                        <div class="post-mini__user-info user__info">--}}
                                    {{--                                            <div class="post-mini__avatar user__avatar">--}}
                                    {{--                                                <a class="user__avatar-link" href="#">--}}
                                    {{--                                                    <img class="post-mini__picture user__picture"--}}
                                    {{--                                                         src="img/userpic-petro.jpg" alt="Аватар пользователя">--}}
                                    {{--                                                </a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="post-mini__name-wrapper user__name-wrapper">--}}
                                    {{--                                                <a class="post-mini__name user__name" href="#">--}}
                                    {{--                                                    <span>Петр Демин</span>--}}
                                    {{--                                                </a>--}}
                                    {{--                                                <div class="post-mini__action">--}}
                                    {{--                                                    <span class="post-mini__activity user__additional">Лайкнул вашу публикацию</span>--}}
                                    {{--                                                    <time class="post-mini__time user__additional"--}}
                                    {{--                                                          datetime="2014-03-20T20:05">15 минут назад--}}
                                    {{--                                                    </time>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="post-mini__preview">--}}
                                    {{--                                            <a class="post-mini__link" href="#" title="Перейти на публикацию">--}}
                                    {{--                                                <span class="visually-hidden">Текст</span>--}}
                                    {{--                                                <svg class="post-mini__preview-icon" width="20" height="21">--}}
                                    {{--                                                    <use xlink:href="#icon-filter-text"></use>--}}
                                    {{--                                                </svg>--}}
                                    {{--                                            </a>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <li class="post-mini post-mini--video post user">--}}
                                    {{--                                        <div class="post-mini__user-info user__info">--}}
                                    {{--                                            <div class="post-mini__avatar user__avatar">--}}
                                    {{--                                                <a class="user__avatar-link" href="#">--}}
                                    {{--                                                    <img class="post-mini__picture user__picture"--}}
                                    {{--                                                         src="img/userpic-petro.jpg" alt="Аватар пользователя">--}}
                                    {{--                                                </a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="post-mini__name-wrapper user__name-wrapper">--}}
                                    {{--                                                <a class="post-mini__name user__name" href="#">--}}
                                    {{--                                                    <span>Петр Демин</span>--}}
                                    {{--                                                </a>--}}
                                    {{--                                                <div class="post-mini__action">--}}
                                    {{--                                                    <span class="post-mini__activity user__additional">Лайкнул вашу публикацию</span>--}}
                                    {{--                                                    <time class="post-mini__time user__additional"--}}
                                    {{--                                                          datetime="2014-03-20T18:20">2 часа назад--}}
                                    {{--                                                    </time>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="post-mini__preview">--}}
                                    {{--                                            <a class="post-mini__link" href="#" title="Перейти на публикацию">--}}
                                    {{--                                                <div class="post-mini__image-wrapper">--}}
                                    {{--                                                    <img class="post-mini__image" src="img/coast-small.png" width="109"--}}
                                    {{--                                                         height="109" alt="Превью публикации">--}}
                                    {{--                                                    <span class="post-mini__play-big">--}}
                                    {{--                            <svg class="post-mini__play-big-icon" width="12" height="13">--}}
                                    {{--                              <use xlink:href="#icon-video-play-big"></use>--}}
                                    {{--                            </svg>--}}
                                    {{--                          </span>--}}
                                    {{--                                                </div>--}}
                                    {{--                                                <span class="visually-hidden">Видео</span>--}}
                                    {{--                                            </a>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <li class="post-mini post-mini--quote post user">--}}
                                    {{--                                        <div class="post-mini__user-info user__info">--}}
                                    {{--                                            <div class="post-mini__avatar user__avatar">--}}
                                    {{--                                                <a class="user__avatar-link" href="#">--}}
                                    {{--                                                    <img class="post-mini__picture user__picture"--}}
                                    {{--                                                         src="img/userpic-petro.jpg" alt="Аватар пользователя">--}}
                                    {{--                                                </a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="post-mini__name-wrapper user__name-wrapper">--}}
                                    {{--                                                <a class="post-mini__name user__name" href="#">--}}
                                    {{--                                                    <span>Петр Демин</span>--}}
                                    {{--                                                </a>--}}
                                    {{--                                                <div class="post-mini__action">--}}
                                    {{--                                                    <span class="post-mini__activity user__additional">Лайкнул вашу публикацию</span>--}}
                                    {{--                                                    <time class="post-mini__time user__additional"--}}
                                    {{--                                                          datetime="2014-03-15T20:05">5 дней назад--}}
                                    {{--                                                    </time>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="post-mini__preview">--}}
                                    {{--                                            <a class="post-mini__link" href="#" title="Перейти на публикацию">--}}
                                    {{--                                                <span class="visually-hidden">Цитата</span>--}}
                                    {{--                                                <svg class="post-mini__preview-icon" width="21" height="20">--}}
                                    {{--                                                    <use xlink:href="#icon-filter-quote"></use>--}}
                                    {{--                                                </svg>--}}
                                    {{--                                            </a>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <li class="post-mini post-mini--link post user">--}}
                                    {{--                                        <div class="post-mini__user-info user__info">--}}
                                    {{--                                            <div class="post-mini__avatar user__avatar">--}}
                                    {{--                                                <a class="user__avatar-link" href="#">--}}
                                    {{--                                                    <img class="post-mini__picture user__picture"--}}
                                    {{--                                                         src="img/userpic-petro.jpg" alt="Аватар пользователя">--}}
                                    {{--                                                </a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="post-mini__name-wrapper user__name-wrapper">--}}
                                    {{--                                                <a class="post-mini__name user__name" href="#">--}}
                                    {{--                                                    <span>Петр Демин</span>--}}
                                    {{--                                                </a>--}}
                                    {{--                                                <div class="post-mini__action">--}}
                                    {{--                                                    <span class="post-mini__activity user__additional">Лайкнул вашу публикацию</span>--}}
                                    {{--                                                    <time class="post-mini__time user__additional"--}}
                                    {{--                                                          datetime="2014-03-20T20:05">в далеком 2007-ом--}}
                                    {{--                                                    </time>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="post-mini__preview">--}}
                                    {{--                                            <a class="post-mini__link" href="#" title="Перейти на публикацию">--}}
                                    {{--                                                <span class="visually-hidden">Ссылка</span>--}}
                                    {{--                                                <svg class="post-mini__preview-icon" width="21" height="18">--}}
                                    {{--                                                    <use xlink:href="#icon-filter-link"></use>--}}
                                    {{--                                                </svg>--}}
                                    {{--                                            </a>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </li>--}}
                                </ul>
                            </section>
                        @endif

                        @if(request()->input('show')==='subscriptions')
                            <section class="profile__subscriptions tabs__content--active">
                                <h2 class="visually-hidden">Подписки</h2>
                                <ul class="profile__subscriptions-list">
                                    @foreach($subscriptions as $subscription)
                                        <li class="post-mini post-mini--photo post user">
                                            <div class="post-mini__user-info user__info">
                                                <div class="post-mini__avatar user__avatar">
                                                    <a class="user__avatar-link" href="#">
                                                        <img class="post-mini__picture user__picture"
                                                             src="{{'/storage/avatars/'.$subscription->user_author->avatar}}"
                                                             alt="Аватар пользователя">
                                                    </a>
                                                </div>
                                                <div class="post-mini__name-wrapper user__name-wrapper">
                                                    <a class="post-mini__name user__name" href="{{route('profile',
                                                        $subscription->user_author->id)}}">
                                                        <span>{{$subscription->user_author->login}}</span>
                                                    </a>
                                                    <time class="post-mini__time user__additional"
                                                          datetime="2014-03-20T20:20">5
                                                        лет на сайте
                                                    </time>
                                                </div>
                                            </div>
                                            <div class="post-mini__rating user__rating">
                                                <p class="post-mini__rating-item user__rating-item user__rating-item--publications">
                                                    <span
                                                            class="post-mini__rating-amount user__rating-amount">
                                                        {{$subscription->user_author->get_posts_count()}}</span>
                                                    <span
                                                            class="post-mini__rating-text user__rating-text">публикаций</span>
                                                </p>
                                                <p class="post-mini__rating-item user__rating-item user__rating-item--subscribers">
                                                    <span
                                                            class="post-mini__rating-amount user__rating-amount">
                                                        {{$subscription->user_author->get_subscribers_count()}}</span>
                                                    <span
                                                            class="post-mini__rating-text user__rating-text">подписчиков</span>
                                                </p>
                                            </div>
                                            <div class="post-mini__user-buttons user__buttons">
                                                @if((auth()->user()->subscribed_on_author($subscription->user_author->id)->exists()))
                                                    @if(auth()->user()->id!==$subscription->user_author->id)
                                                        <form method="post"
                                                              action="{{route('unsubscribe',$subscription->author)}}">
                                                            @csrf
                                                            <button
                                                                    class="post-mini__user-button user__button user__button--subscription button button--quartz"
                                                                    type="submit">Отписаться
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form method="post"
                                                              action="{{route('subscribe',$subscription->author)}}">
                                                            @csrf
                                                            <button
                                                                    class="post-mini__user-button user__button user__button--subscription button button--main"
                                                                    type="submit">Подписаться
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </section>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
