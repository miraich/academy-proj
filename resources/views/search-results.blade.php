@extends('layouts.app')

@section('title','readme: результат поиска')

@section('content')
    <main class="page__main page__main--search-results">
        <h1 class="visually-hidden">Страница результатов поиска</h1>
        <section class="search">
            <h2 class="visually-hidden">Результаты поиска</h2>
            <div class="search__query-wrapper">
                <div class="search__query container">
                    <span>Вы искали:</span>
                    <span class="search__query-text">{{request()->input('search_content')}}</span>
                </div>
            </div>
            <div class="search__results-wrapper">
                <div class="container">
                    <div class="search__content">
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
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
