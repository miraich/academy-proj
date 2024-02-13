@extends('layouts.app')

@section('title','readme: моя лента')

@section('content')
    <section class="page__main page__main--popular">
        <div class="container">
            <h1 class="page__title page__title--popular">Популярное</h1>
        </div>
        <div class="popular container">
            <div class="popular__filters-wrapper">
                <div class="popular__sorting sorting">
                    <b class="popular__sorting-caption sorting__caption">Сортировка:</b>
                    <ul class="popular__sorting-list sorting__list">
                        <li class="sorting__item sorting__item--popular">
                            <a class="sorting__link sorting__link--active"
                               href="{{route('popular','category=popular')}}">
                                <span>Популярность</span>
                                <img src="{{asset('img/icon-sort.svg')}}" class="sorting__icon" width="10" height="12">
                            </a>
                        </li>
                        <li class="sorting__item">
                            <a class="sorting__link" href="{{route('popular','category=likes')}}">
                                <span>Лайки</span>
                                <img src="{{asset('img/icon-sort.svg')}}" class="sorting__icon" width="10" height="12">
                            </a>
                        </li>
                        <li class="sorting__item">
                            <a class="sorting__link" href="{{route('popular','category=date')}}">
                                <span>Дата</span>
                                <img src="{{asset('img/icon-sort.svg')}}" class="sorting__icon" width="10" height="12">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="popular__filters filters">
                    <b class="popular__filters-caption filters__caption">Тип контента:</b>
                    <ul class="popular__filters-list filters__list">
                        <li class="popular__filters-item popular__filters-item--all filters__item filters__item--all">
                            <a class="filters__button filters__button--ellipse filters__button--all filters__button--active"
                               href="{{route('popular','category=all')}}">
                                <span>Все</span>
                            </a>
                        </li>
                        <li class="popular__filters-item filters__item">
                            <a class="filters__button filters__button--photo button"
                               href="{{route('popular','category=photo')}}">
                                <span class="visually-hidden">Фото</span>
                                <img src="{{asset('img/icon-filter-photo.svg')}}" class="filters__icon" width="22"
                                     height="18">
                            </a>
                        </li>
                        <li class="popular__filters-item filters__item">
                            <a class="filters__button filters__button--video button"
                               href="{{route('popular','category=video')}}">
                                <span class="visually-hidden">Видео</span>
                                <img src="{{asset('img/icon-filter-video.svg')}}" class="filters__icon" width="24"
                                     height="16">
                            </a>
                        </li>
                        <li class="popular__filters-item filters__item">
                            <a class="filters__button filters__button--text button"
                               href="{{route('popular','category=text')}}">
                                <span class="visually-hidden">Текст</span>
                                <img src="{{asset('img/icon-filter-text.svg')}}" class="filters__icon" width="20"
                                     height="21">
                            </a>
                        </li>
                        <li class="popular__filters-item filters__item">
                            <a class="filters__button filters__button--quote button"
                               href="{{route('popular','category=quote')}}">
                                <span class="visually-hidden">Цитата</span>
                                <img src="{{asset('img/icon-filter-quote.svg')}}" class="filters__icon" width="21"
                                     height="20">
                            </a>
                        </li>
                        <li class="popular__filters-item filters__item">
                            <a class="filters__button filters__button--link button"
                               href="{{route('popular','category=link')}}">
                                <span class="visually-hidden">Ссылка</span>
                                <img src="{{asset('img/icon-filter-link.svg')}}" class="filters__icon" width="21"
                                     height="18">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="popular__posts">
                @if(!$posts->isEmpty())
                    @foreach($posts as $post)
                        @switch($post->category)
                            @case(\App\Enums\CategoryEnum::PHOTO->value)
                                <article class="popular__post post post-photo">
                                    <header class="post__header">
                                        <h2><a href="{{route('show_post',$post->id)}}">{{$post->title}}</a></h2>
                                    </header>
                                    <div class="post__main">
                                        <div class="post-photo__image-wrapper">
                                            <img src="{{asset('storage/avatars/'.$post->user->avatar)}}"
                                                 alt="Фото от пользователя" width="360"
                                                 height="240">
                                        </div>
                                    </div>
                                    <footer class="post__footer">
                                        <div class="post__author">
                                            <a class="post__author-link" href="{{route('profile',$post->user_id)}}"
                                               title="Автор">
                                                <div class="post__avatar-wrapper">
                                                    <img class="post__author-avatar" src="img/userpic-larisa-small.jpg"
                                                         alt="Аватар пользователя">
                                                </div>
                                                <div class="post__info">
                                                    <b class="post__author-name">{{$post->user->login}}</b>
                                                    <time class="post__time"
                                                          datetime="2019-03-30">{{$post->created_at}}</time>
                                                </div>
                                            </a>
                                        </div>
                                        @include('components.post-details-indicators')
                                        @include('components.post-tags')
                                    </footer>
                                </article>
                                @break
                            @case(\App\Enums\CategoryEnum::VIDEO->value)
                                <article class="popular__post post post-video">
                                    <header class="post__header">
                                        <h2><a href="{{route('show_post',$post->id)}}">{{$post->title}}</a></h2>
                                    </header>
                                    <div class="post__main">
                                        <div class="post-video__block">
                                            <div class="post-video__preview">
                                                <img src="img/coast-medium.jpg" alt="Превью к видео" width="360"
                                                     height="188">
                                            </div>
                                            <div class="post-video__control">
                                                <button
                                                    class="post-video__play post-video__play--paused button button--video"
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
                                                    type="button"><span
                                                        class="visually-hidden">Полноэкранный режим</span>
                                                </button>
                                            </div>
                                            <button class="post-video__play-big button" type="button">
                                                <svg class="post-video__play-big-icon" width="14" height="14">
                                                    <use xlink:href="#icon-video-play-big"></use>
                                                </svg>
                                                <span class="visually-hidden">Запустить проигрыватель</span>
                                            </button>
                                        </div>
                                    </div>
                                    <footer class="post__footer">
                                        <div class="post__author">
                                            <a class="post__author-link" href="{{route('profile',$post->user_id)}}"
                                               title="Автор">
                                                <div class="post__avatar-wrapper">
                                                    <img class="post__author-avatar"
                                                         src="{{asset('storage/avatars/'.$post->user->avatar)}}"
                                                         alt="Аватар пользователя">
                                                </div>
                                                <div class="post__info">
                                                    <b class="post__author-name">{{$post->user->login}}</b>
                                                    <time class="post__time"
                                                          datetime="2019-03-30">{{$post->created_at}}</time>
                                                </div>
                                            </a>
                                        </div>
                                        @include('components.post-details-indicators')
                                        @include('components.post-tags')
                                    </footer>
                                </article>
                                @break
                            @case(\App\Enums\CategoryEnum::TEXT->value)
                                <article class="popular__post post post-text">
                                    <header class="post__header">
                                        <h2><a href="{{route('show_post',$post->id)}}">{{$post->title}}</a></h2>
                                    </header>
                                    <div class="post__main">
                                        <p>
                                            {{$post->content}}
                                        </p>
                                        <div class="post-text__more-link-wrapper">
                                            <a class="post-text__more-link" href="#">Читать далее</a>
                                        </div>
                                    </div>
                                    <footer class="post__footer">
                                        <div class="post__author">
                                            <a class="post__author-link" href="{{route('profile',$post->user_id)}}"
                                               title="Автор">
                                                <div class="post__avatar-wrapper">
                                                    <img class="post__author-avatar"
                                                         src="{{asset('storage/avatars/'.$post->user->avatar)}}"
                                                         alt="Аватар пользователя">
                                                </div>
                                                <div class="post__info">
                                                    <b class="post__author-name">{{$post->user->login}}</b>
                                                    <time class="post__time"
                                                          datetime="2019-03-30">{{$post->created_at}}</time>
                                                </div>
                                            </a>
                                        </div>
                                        @include('components.post-details-indicators')
                                        @include('components.post-tags')
                                    </footer>
                                </article>
                                @break
                            @case(\App\Enums\CategoryEnum::QUOTE->value)
                                <article class="popular__post post post-quote">
                                    <header class="post__header">
                                        <h2><a href="{{route('show_post',$post->id)}}">{{$post->title}}</a></h2>
                                    </header>
                                    <div class="post__main">
                                        <blockquote>
                                            <p>
                                                {{$post->content}}
                                            </p>
                                            <cite>{{$post->quote_author}}</cite>
                                        </blockquote>
                                    </div>
                                    <footer class="post__footer">
                                        <div class="post__author">
                                            <a class="post__author-link" href="{{route('profile',$post->user_id)}}"
                                               title="Автор">
                                                <div class="post__avatar-wrapper">
                                                    <img class="post__author-avatar"
                                                         src="{{asset('storage/avatars/'.$post->user->avatar)}}"
                                                         alt="Аватар пользователя">
                                                </div>
                                                <div class="post__info">
                                                    <b class="post__author-name">{{$post->user->login}}</b>
                                                    <time class="post__time" datetime="2019-03-30"
                                                          title="30.03.2019 15:34">
                                                        {{$post->created_at}}
                                                    </time>
                                                </div>
                                            </a>
                                        </div>
                                        @include('components.post-details-indicators')
                                        @include('components.post-tags')
                                    </footer>
                                </article>
                                @break
                            @case(\App\Enums\CategoryEnum::LINK->value)
                                <article class="popular__post post post-link">
                                    <header class="post__header">
                                        <h2><a href="{{route('show_post',$post->id)}}">{{$post->title}}</a></h2>
                                    </header>
                                    <div class="post__main">
                                        <div class="post-link__wrapper">
                                            <a class="post-link__external" href="http://www.vitadental.ru"
                                               title="Перейти по ссылке">
                                                <div class="post-link__info-wrapper">
                                                    <div class="post-link__icon-wrapper">
                                                        <img src="{{asset('storage/previews/'.$post->img)}}"
                                                             alt="Иконка">
                                                    </div>
                                                    <div class="post-link__info">
                                                        <h3>Ссылка</h3>
                                                        <p>Описание</p>
                                                    </div>
                                                </div>
                                                <span>{{$post->link}}</span>
                                            </a>
                                        </div>
                                    </div>
                                    <footer class="post__footer">
                                        <div class="post__author">
                                            <a class="post__author-link" href="{{route('profile',$post->user_id)}}"
                                               title="Автор">
                                                <div class="post__avatar-wrapper">
                                                    <img class="post__author-avatar"
                                                         src="{{asset('storage/avatars/'.$post->user->avatar)}}"
                                                         alt="Аватар пользователя">
                                                </div>
                                                <div class="post__info">
                                                    <b class="post__author-name">{{$post->user->login}}</b>
                                                    <time class="post__time"
                                                          datetime="2019-03-30">{{$post->created_at}}</time>
                                                </div>
                                            </a>
                                        </div>
                                        @include('components.post-details-indicators')
                                        @include('components.post-tags')
                                    </footer>
                                </article>
                                @break
                        @endswitch
                    @endforeach
                @endif
            </div>
            {{$posts->links('pagination.pagination-links')}}
        </div>
    </section>
@endsection
