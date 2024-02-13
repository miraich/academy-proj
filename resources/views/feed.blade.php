@extends('layouts.app')

@section('title','readme: моя лента')

@section('content')
    <main class="page__main page__main--feed">
        <div class="container">
            <h1 class="page__title page__title--feed">Моя лента</h1>
        </div>
        <div class="page__main-wrapper container">
            <section class="feed">
                <h2 class="visually-hidden">Лента</h2>
                <div class="feed__main-wrapper">
                    <div class="feed__wrapper">
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
                    </div>
                </div>
                <ul class="feed__filters filters">
                    <li class="feed__filters-item filters__item">
                        <a class="filters__button filters__button--active"
                           href="{{route('feed','&category=all')}}">
                            <span>Все</span>
                        </a>
                    </li>
                    <li class="feed__filters-item filters__item">
                        <a class="filters__button filters__button--photo button"
                           href="{{route('feed','&category=photo')}}">
                            <span class="visually-hidden">Фото</span>
                            <img src="{{asset('img/icon-filter-photo.svg')}}" class="filters__icon" width="22"
                                 height="18">
                        </a>
                    </li>
                    <li class="feed__filters-item filters__item">
                        <a class="filters__button filters__button--video button"
                           href="{{route('feed','&category=video')}}">
                            <span class="visually-hidden">Видео</span>
                            <img src="{{asset('img/icon-filter-video.svg')}}" class="filters__icon" width="24"
                                 height="16">
                        </a>
                    </li>
                    <li class="feed__filters-item filters__item">
                        <a class="filters__button filters__button--text button"
                           href="{{route('feed','&category=text')}}">
                            <span class="visually-hidden">Текст</span>
                            <img src="{{asset('img/icon-filter-text.svg')}}" class="filters__icon" width="20"
                                 height="21">
                        </a>
                    </li>
                    <li class="feed__filters-item filters__item">
                        <a class="filters__button filters__button--quote button"
                           href="{{route('feed','&category=quote')}}">
                            <span class="visually-hidden">Цитата</span>
                            <img src="{{asset('img/icon-filter-quote.svg')}}" class="filters__icon" width="21"
                                 height="20">
                        </a>
                    </li>
                    <li class="feed__filters-item filters__item">
                        <a class="filters__button filters__button--link button"
                           href="{{route('feed','&category=link')}}">
                            <span class="visually-hidden">Ссылка</span>
                            <img src="{{asset('img/icon-filter-link.svg')}}" class="filters__icon" width="21"
                                 height="18">
                        </a>
                    </li>
                </ul>
            </section>
            <aside class="promo">
                <article class="promo__block promo__block--barbershop">
                    <h2 class="visually-hidden">Рекламный блок</h2>
                    <p class="promo__text">
                        Все еще сидишь на окладе в офисе? Открой свой барбершоп по нашей франшизе!
                    </p>
                    <a class="promo__link" href="#">
                        Подробнее
                    </a>
                </article>
                <article class="promo__block promo__block--technomart">
                    <h2 class="visually-hidden">Рекламный блок</h2>
                    <p class="promo__text">
                        Товары будущего уже сегодня в онлайн-сторе Техномарт!
                    </p>
                    <a class="promo__link" href="#">
                        Перейти в магазин
                    </a>
                </article>
                <article class="promo__block">
                    <h2 class="visually-hidden">Рекламный блок</h2>
                    <p class="promo__text">
                        Здесь<br> могла быть<br> ваша реклама
                    </p>
                    <a class="promo__link" href="#">
                        Разместить
                    </a>
                </article>
            </aside>
        </div>
    </main>
@endsection

@section('filters-js')
    <script src="{{asset('js/filters.js')}}"></script>
@endsection
