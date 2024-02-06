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
                        <section class="adding-post__photo tabs__content tabs__content--active">
                            <h2 class="visually-hidden">Форма добавления фото</h2>
                            <form class="adding-post__form form" action="{{route('create_post_photo')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="form__text-inputs-wrapper">
                                    <div class="form__text-inputs">
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="photo-heading">Заголовок
                                                <span class="form__input-required">*</span></label>
                                            <div
                                                    class="form__input-section @error('photo_heading') form__input-section--error @enderror">
                                                <input class="adding-post__input form__input" id="photo-heading"
                                                       type="text" name="photo_heading" value="{{old('photo_heading')}}"
                                                       placeholder="Введите заголовок">
                                                <button class="form__error-button button" type="button">!<span
                                                            class="visually-hidden">Информация об ошибке</span></button>
                                                @error('photo_heading')
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок</h3>
                                                    <p class="form__error-desc">{{$message}}</p>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="photo-url">Ссылка из
                                                интернета<span class="form__input-required"> *</span></label></label>
                                            <div
                                                    class="form__input-section @error('link') form__input-section--error @enderror">
                                                <input class="adding-post__input form__input" id="photo-url" type="text"
                                                       name="link" placeholder="Введите ссылку" value="{{old('link')}}">
                                                <button class="form__error-button button" type="button">!<span
                                                            class="visually-hidden">Информация об ошибке</span></button>
                                                @error('link')
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Ссылка</h3>
                                                    <p class="form__error-desc">{{$message}}</p>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="photo-tags">Теги<span
                                                        class="form__input-required"> *</span></label>
                                            <div
                                                    class="form__input-section @error('tags') form__input-section--error @enderror">
                                                <input class="adding-post__input form__input" id="photo-tags"
                                                       type="text" name="tags" placeholder="Введите теги"
                                                       value="{{old('tags')}}">
                                                <button class="form__error-button button" type="button">!<span
                                                            class="visually-hidden">Информация об ошибке</span></button>
                                                @error('tags')
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Теги</h3>
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
                                <div
                                        class="adding-post__input-file-container form__input-container form__input-container--file">
                                    <div class="adding-post__input-file-wrapper form__input-file-wrapper">
                                        <div
                                                class="adding-post__file-zone adding-post__file-zone--photo form__file-zone dropzone">
                                            {{--                                            <input class="adding-post__input-file form__input-file"--}}
                                            {{--                                                   id="userpic-file-photo" type="file" name="userpic-file-photo"--}}
                                            {{--                                                   title=" ">--}}
                                            <div class="form__file-zone-text">
                                                <span>Перетащите фото сюда</span>
                                            </div>
                                        </div>
                                        <button
                                                class="adding-post__input-file-button form__input-file-button form__input-file-button--photo button"
                                                type="button">
                                            <span>Выбрать фото</span>
                                            <img src="{{asset('img/icon-attach.svg')}}"
                                                 class="adding-post__attach-icon form__attach-icon" width="10"
                                                 height="20">
                                            <input class="adding-post__input-file form__input-file"
                                                   id="userpic-file-photo" type="file" name="userpic-file-photo"
                                                   title=" ">
                                        </button>
                                    </div>
                                    <div
                                            class="adding-post__file adding-post__file--photo form__file dropzone-previews">

                                    </div>
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


