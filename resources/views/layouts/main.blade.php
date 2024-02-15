<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{--    <title>readme: блог, каким он должен быть</title>--}}
    <title>readme: блог, каким он должен быть</title>
    <link rel="stylesheet" href="{{asset('build/assets/app-J8otDaRz.css')}}">
</head>

<body class="page page--main">

<header class="header page__header">
    <div class="header__wrapper page__header-wrapper container">
        <div class="header__logo-wrapper page__logo-wrapper">
            <a class="header__logo-link header__logo-link--active">
                <img class="header__logo" src="{{asset('img/logo.svg')}}" alt="Логотип readme" width="172" height="32">
            </a>
            <p class="header__topic page__header-topic">
                micro blogging
            </p>
        </div>
        <div class="header__nav-wrapper">
            <nav class="header__nav">
                <ul class="header__user-nav page__user-nav">
                    <li class="page__user-item">
            <span class="header__register-slogan">
              Еще нет аккаунта?
            </span>
                        <a class="header__user-button header__register-button button button--transparent"
                           href="{{route('show_registration')}}">Регистрация</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>


<main>
    <h1 class="visually-hidden">Главная страница сайта по созданию микроблога readme</h1>
    <div class="page__main-wrapper page__main-wrapper--intro container">
        <section class="intro">
            <h2 class="visually-hidden">Наши преимущества</h2>
            <b class="intro__slogan">Блог, каким<br> он должен быть</b>
            <ul class="intro__advantages-list">
                <li class="intro__advantage intro__advantage--ease">
                    <p class="intro__advantage-text">
                        Есть все необходимое для&nbsp;простоты публикации
                    </p>
                </li>
                <li class="intro__advantage intro__advantage--no-excess">
                    <p class="intro__advantage-text">
                        Нет ничего лишнего, отвлекающего от сути
                    </p>
                </li>
            </ul>
        </section>

        <section class="authorization">
            <h2 class="visually-hidden">Авторизация</h2>
            <form class="authorization__form form" action="{{route('login')}}" method="post">
                @csrf
                @method('post')
                <div class="authorization__input-wrapper form__input-wrapper">
                    <div class="form__input-section @error('email') form__input-section--error @enderror">
                        <input class="authorization__input authorization__input--login form__input" type="email"
                               name="email" placeholder="email">
                        <svg class="form__input-icon" width="19" height="18">
                            <use xlink:href="#icon-input-user"></use>
                        </svg>
                        <label class="visually-hidden">Email</label>
                    </div>
                    @error('email')
                    <span class="form__error-label form__error-label--login">{{$message}}</span>
                    @enderror
                </div>
                <div class="authorization__input-wrapper form__input-wrapper">
                    <div class="form__input-section @error('password') form__input-section--error @enderror">
                        <input class="authorization__input authorization__input--password form__input" type="password"
                               name="password" placeholder="Пароль">
                        <svg class="form__input-icon" width="16" height="20">
                            <use xlink:href="#icon-input-password"></use>
                        </svg>
                        <label class="visually-hidden">Пароль</label>
                    </div>
                    @error('password')
                    <span class="form__error-label">{{$message}}</span>
                    @enderror
                    @if(session('error_not_exist'))
                        <span style="color: red;"> {{session('error_not_exist')}}</span>
                    @endif
                </div>
                <a class="authorization__recovery" href="#">Восстановить пароль</a>
                <button class="authorization__submit button button--main" type="submit">Войти</button>
            </form>
        </section>

    </div>
</main>

<footer class="footer footer--main">
    <div class="footer__wrapper">
        <div class="footer__container container">
            <div class="footer__site-info">
                <div class="footer__site-nav">
                    <ul class="footer__info-pages">
                        <li class="footer__info-page">
                            <a class="footer__page-link" href="#">О проекте</a>
                        </li>
                        <li class="footer__info-page">
                            <a class="footer__page-link" href="#">Реклама</a>
                        </li>
                        <li class="footer__info-page">
                            <a class="footer__page-link" href="#">О разработчиках</a>
                        </li>
                        <li class="footer__info-page">
                            <a class="footer__page-link" href="#">Работа в Readme</a>
                        </li>
                        <li class="footer__info-page">
                            <a class="footer__page-link" href="#">Соглашение пользователя</a>
                        </li>
                        <li class="footer__info-page">
                            <a class="footer__page-link" href="#">Политика конфиденциальности</a>
                        </li>
                    </ul>
                </div>
                <p class="footer__license">
                    При использовании любых материалов с сайта обязательно указание Readme в качестве источника. Все
                    авторские и исключительные права в рамках проекта защищены в соответствии с положениями 4 части
                    Гражданского Кодекса Российской Федерации.
                </p>
            </div>
            <div class="footer__my-info">
                <ul class="footer__my-pages">
                    <li class="footer__my-page footer__my-page--feed">
                        <a class="footer__page-link" href="feed.html">Моя лента</a>
                    </li>
                    <li class="footer__my-page footer__my-page--popular">
                        <a class="footer__page-link" href="popular.html">Популярный контент</a>
                    </li>
                    <li class="footer__my-page footer__my-page--messages">
                        <a class="footer__page-link" href="messages.html">Личные сообщения</a>
                    </li>
                </ul>
                <div class="footer__copyright">
                    <a class="footer__copyright-link" href="https://htmlacademy.ru">
                        <span>Разработано HTML Academy</span>
                        <svg class="footer__copyright-logo" width="27" height="34">
                            <use xlink:href="#icon-htmlacademy"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{asset('build/assets/app-wnYFKRVn.js')}}"></script>
</body>
</html>
