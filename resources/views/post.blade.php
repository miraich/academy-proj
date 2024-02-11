@extends('layouts.app')

@section('title','readme: публикация')

@section('content')
    <main class="page__main page__main--publication">
        <div class="container">
            <h1 class="page__title page__title--publication">{{$post->title}}</h1>
            <section class="post-details">
                <h2 class="visually-hidden">Публикация</h2>
                @switch($post->category)
                    @case(\App\Enums\CategoryEnum::PHOTO->value)
                        @include('post-types-details.post-photo')
                        @break
                    @case(\App\Enums\CategoryEnum::VIDEO->value)
                        @include('post-types-details.post-video')
                        @break
                    @case(\App\Enums\CategoryEnum::TEXT->value)
                        @include('post-types-details.post-text')
                        @break
                    @case(\App\Enums\CategoryEnum::QUOTE->value)
                        @include('post-types-details.post-quote')
                        @break
                    @case(\App\Enums\CategoryEnum::LINK->value)
                        @include('post-types-details.post-link')
                        @break
                @endswitch
            </section>
        </div>
    </main>
@endsection
