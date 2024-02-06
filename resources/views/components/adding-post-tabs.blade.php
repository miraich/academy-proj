<div class="adding-post__tabs filters">
    <ul class="adding-post__tabs-list filters__list tabs__list">
        <li class="adding-post__tabs-item filters__item">
            <a class="adding-post__tabs-link filters__button filters__button--photo @if(request()->routeIs('show_adding_post_photo')) filters__button--active @endif"
               href="{{route('show_adding_post_photo')}}">
                <img src="img/icon-filter-photo.svg" class="filters__icon" width="22" height="18" alt="photo">
                <span>Фото</span>
            </a>
        </li>
        <li class="adding-post__tabs-item filters__item">
            <a class="adding-post__tabs-link filters__button filters__button--video @if(request()->routeIs('show_adding_post_video')) filters__button--active @endif"
               href="{{route('show_adding_post_video')}}">
                <img src="img/icon-filter-video.svg" class="filters__icon" width="24" height="16">
                <span>Видео</span>
            </a>
        </li>
        <li class="adding-post__tabs-item filters__item">
            <a class="adding-post__tabs-link filters__button filters__button--text @if(request()->routeIs('show_adding_post_text')) filters__button--active @endif"
               href="{{route('show_adding_post_text')}}">
                <img src="img/icon-filter-text.svg" class="filters__icon" width="20" height="21">
                <span>Текст</span>
            </a>
        </li>
        <li class="adding-post__tabs-item filters__item">
            <a class="adding-post__tabs-link filters__button filters__button--quote @if(request()->routeIs('show_adding_post_quote')) filters__button--active @endif"
               href="{{route('show_adding_post_quote')}}">
                <img src="img/icon-filter-quote.svg" class="filters__icon" width="21" height="20">
                <span>Цитата</span>
            </a>
        </li>
        <li class="adding-post__tabs-item filters__item">
            <a class="adding-post__tabs-link filters__button filters__button--link @if(request()->routeIs('show_adding_post_link')) filters__button--active @endif"
               href="{{route('show_adding_post_link')}}">
                <img src="img/icon-filter-link.svg" class="filters__icon" width="21" height="18">
                <span>Ссылка</span>
            </a>
        </li>
    </ul>
</div>

