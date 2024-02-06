@extends('layouts.app')

@section('title','readme: добавление публикации')

@section('content')
    <main class="page__main page__main--adding-post">
        <div class="page__main-section">
            <div class="container">
                <h1 class="page__title page__title--adding-post">Добавить публикацию</h1>
            </div>
            <div class="adding-post container">
                <div class="adding-post__tabs-wrapper tabs">
                    @include('components.adding-post-tabs')
                    <div class="adding-post__tab-content">
                        <section class="adding-post__quote tabs__content tabs__content--active">
                            <h2 class="visually-hidden">Форма добавления цитаты</h2>
                            <form class="adding-post__form form" action="{{route('create_post_quote')}}" method="post">
                                @csrf
                                @method('post')
                                <div class="form__text-inputs-wrapper">
                                    <div class="form__text-inputs">
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="quote-heading">Заголовок
                                                <span class="form__input-required">*</span></label>
                                            <div
                                                class="form__input-section @error('quote_heading') form__input-section--error @enderror">
                                                <input class="adding-post__input form__input" id="quote-heading"
                                                       type="text" value="{{old('quote_heading')}}"
                                                       name="quote_heading" placeholder="Введите заголовок">
                                                <button class="form__error-button button" type="button">!<span
                                                        class="visually-hidden">Информация об ошибке</span></button>
                                                @error('quote_heading')
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок</h3>
                                                    <p class="form__error-desc">{{$message}}</p>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="adding-post__input-wrapper form__textarea-wrapper">
                                            <label class="adding-post__label form__label" for="cite-text">Текст цитаты
                                                <span
                                                    class="form__input-required">*</span></label>
                                            <div
                                                class="form__input-section @error('quote_text') form__input-section--error @enderror">
                          <textarea
                              class="adding-post__textarea adding-post__textarea--quote form__textarea form__input"
                              id="cite-text" name="quote_text"
                              placeholder="Текст цитаты">{{old('quote_text')}}</textarea>
                                                <button class="form__error-button button" type="button">!<span
                                                        class="visually-hidden">Информация об ошибке</span></button>
                                                @error('quote_text')
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок</h3>
                                                    <p class="form__error-desc">{{$message}}</p>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="adding-post__textarea-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="quote-author">Автор <span
                                                    class="form__input-required">*</span></label>
                                            <div
                                                class="form__input-section @error('quote_author') form__input-section--error @enderror">
                                                <input class="adding-post__input form__input" id="quote-author"
                                                       type="text" value="{{old('quote_author')}}"
                                                       name="quote_author">
                                                <button class="form__error-button button" type="button">!<span
                                                        class="visually-hidden">Информация об ошибке</span></button>
                                                @error('quote_author')
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок</h3>
                                                    <p class="form__error-desc">{{$message}}</p>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="cite-tags">Теги <span
                                                    class="form__input-required">*</span></label>
                                            <div
                                                class="form__input-section @error('tags') form__input-section--error @enderror">
                                                <input class="adding-post__input form__input" id="cite-tags" type="text"
                                                       name="tags" placeholder="Введите теги">
                                                <button class="form__error-button button" type="button">!<span
                                                        class="visually-hidden">Информация об ошибке</span></button>
                                                @error('tags')
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок</h3>
                                                    <p class="form__error-desc">{{$message}}</p>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @if($errors->any())
                                        <div class="form__invalid-block">
                                            <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                                            <ul class="form__invalid-list">
                                                @foreach ($errors->all() as $error)
                                                    <li class="form__invalid-item">{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="adding-post__buttons">
                                    <button class="adding-post__submit button button--main" type="submit">Опубликовать
                                    </button>
                                    <a class="adding-post__close" href="#">Закрыть</a>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection



