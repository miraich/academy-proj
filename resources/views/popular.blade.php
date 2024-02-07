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
                            <a class="sorting__link sorting__link--active" href="#">
                                <span>Популярность</span>
                                <svg class="sorting__icon" width="10" height="12">
                                    <use xlink:href="#icon-sort"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="sorting__item">
                            <a class="sorting__link" href="#">
                                <span>Лайки</span>
                                <svg class="sorting__icon" width="10" height="12">
                                    <use xlink:href="#icon-sort"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="sorting__item">
                            <a class="sorting__link" href="#">
                                <span>Дата</span>
                                <svg class="sorting__icon" width="10" height="12">
                                    <use xlink:href="#icon-sort"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="popular__filters filters">
                    <b class="popular__filters-caption filters__caption">Тип контента:</b>
                    <ul class="popular__filters-list filters__list">
                        <li class="popular__filters-item popular__filters-item--all filters__item filters__item--all">
                            <a class="filters__button filters__button--ellipse filters__button--all filters__button--active"
                               href="#">
                                <span>Все</span>
                            </a>
                        </li>
                        <li class="popular__filters-item filters__item">
                            <a class="filters__button filters__button--photo button" href="#">
                                <span class="visually-hidden">Фото</span>
                                <svg class="filters__icon" width="22" height="18">
                                    <use xlink:href="#icon-filter-photo"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="popular__filters-item filters__item">
                            <a class="filters__button filters__button--video button" href="#">
                                <span class="visually-hidden">Видео</span>
                                <svg class="filters__icon" width="24" height="16">
                                    <use xlink:href="#icon-filter-video"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="popular__filters-item filters__item">
                            <a class="filters__button filters__button--text button" href="#">
                                <span class="visually-hidden">Текст</span>
                                <svg class="filters__icon" width="20" height="21">
                                    <use xlink:href="#icon-filter-text"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="popular__filters-item filters__item">
                            <a class="filters__button filters__button--quote button" href="#">
                                <span class="visually-hidden">Цитата</span>
                                <svg class="filters__icon" width="21" height="20">
                                    <use xlink:href="#icon-filter-quote"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="popular__filters-item filters__item">
                            <a class="filters__button filters__button--link button" href="#">
                                <span class="visually-hidden">Ссылка</span>
                                <svg class="filters__icon" width="21" height="18">
                                    <use xlink:href="#icon-filter-link"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="popular__posts">
                @foreach($posts as $post)
                    @switch($post->category)
                        @case(\App\Enums\CategoryEnum::PHOTO->value)
                            <article class="popular__post post post-photo">
                                <header class="post__header">
                                    <h2><a href="{{route('show_post',$post->id)}}">{{$post->title}}</a></h2>
                                </header>
                                <div class="post__main">
                                    <div class="post-photo__image-wrapper">
                                        <img src="{{asset('storage/post_photo/'.$post->img)}}"
                                             alt="Фото от пользователя" width="360"
                                             height="240">
                                    </div>
                                </div>
                                <footer class="post__footer">
                                    <div class="post__author">
                                        <a class="post__author-link" href="#" title="Автор">
                                            <div class="post__avatar-wrapper">
                                                <img class="post__author-avatar" src="img/userpic-larisa-small.jpg"
                                                     alt="Аватар пользователя">
                                            </div>
                                            <div class="post__info">
                                                <b class="post__author-name">{{$post->user->login}}</b>
                                                <time class="post__time" datetime="2019-03-30">{{$post->created_at}}</time>
                                            </div>
                                        </a>
                                    </div>
                                    @include('components.post-details-indicators')
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
                                                type="button"><span class="visually-hidden">Полноэкранный режим</span>
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
                                        <a class="post__author-link" href="#" title="Автор">
                                            <div class="post__avatar-wrapper">
                                                <img class="post__author-avatar" src="img/userpic-larisa-small.jpg"
                                                     alt="Аватар пользователя">
                                            </div>
                                            <div class="post__info">
                                                <b class="post__author-name">{{$post->user->login}}</b>
                                                <time class="post__time" datetime="2019-03-30">{{$post->created_at}}</time>
                                            </div>
                                        </a>
                                    </div>
                                    @include('components.post-details-indicators')
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
                                        <a class="post__author-link" href="#" title="Автор">
                                            <div class="post__avatar-wrapper">
                                                <img class="post__author-avatar" src="img/userpic-larisa-small.jpg"
                                                     alt="Аватар пользователя">
                                            </div>
                                            <div class="post__info">
                                                <b class="post__author-name">{{$post->user->login}}</b>
                                                <time class="post__time" datetime="2019-03-30">{{$post->created_at}}</time>
                                            </div>
                                        </a>
                                    </div>
                                    @include('components.post-details-indicators')
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
                                        <a class="post__author-link" href="#" title="Автор">
                                            <div class="post__avatar-wrapper">
                                                <img class="post__author-avatar" src="img/userpic-larisa-small.jpg"
                                                     alt="Аватар пользователя">
                                            </div>
                                            <div class="post__info">
                                                <b class="post__author-name">{{$post->user->login}}</b>
                                                <time class="post__time" datetime="2019-03-30" title="30.03.2019 15:34">
                                                    {{$post->created_at}}
                                                </time>
                                            </div>
                                        </a>
                                    </div>
                                    @include('components.post-details-indicators')
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
                                                    <img src="{{asset('storage/previews/'.$post->img)}}" alt="Иконка">
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
                                        <a class="post__author-link" href="#" title="Автор">
                                            <div class="post__avatar-wrapper">
                                                <img class="post__author-avatar" src="img/userpic-larisa-small.jpg"
                                                     alt="Аватар пользователя">
                                            </div>
                                            <div class="post__info">
                                                <b class="post__author-name">{{$post->user->login}}</b>
                                                <time class="post__time" datetime="2019-03-30">{{$post->created_at}}</time>
                                            </div>
                                        </a>
                                    </div>
                                    @include('components.post-details-indicators')
                                </footer>
                            </article>
                            @break
                    @endswitch
                @endforeach
            </div>
            <div class="popular__page-links">
                <a class="popular__page-link popular__page-link--prev button button--gray" href="#">Предыдущая
                    страница</a>
                <a class="popular__page-link popular__page-link--next button button--gray" href="#">Следующая
                    страница</a>
            </div>
        </div>
    </section>
@endsection
