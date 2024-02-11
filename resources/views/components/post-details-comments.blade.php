<div class="comments">
    <form class="comments__form form" action="{{route('create_comment',$post->id)}}" method="post">
        @csrf
        @method('post')
        <div class="comments__my-avatar">
            <img class="comments__picture" src="{{asset("storage/avatars/".auth()->user()->avatar)}}"
                 alt="Аватар пользователя">
        </div>
        <div class="form__input-section @error('comment') form__input-section--error @enderror">
                    <textarea class="comments__textarea form__textarea form__input"
                              placeholder="Ваш комментарий" name="comment">{{old('comment')}}</textarea>
            <label class="visually-hidden">Ваш комментарий</label>
            <button class="form__error-button button" type="button">!</button>
            @error('comment')
            <div class="form__error-text">
                <h3 class="form__error-title">Комментарий</h3>
                <p class="form__error-desc">{{$message}}</p>
            </div>
            @enderror
        </div>
        <button class="comments__submit button button--green" type="submit">Отправить
        </button>
    </form>
    @if($post->comments()->exists())
        <div class="comments__list-wrapper">
            <ul class="comments__list">
                @foreach($post->comments as $comment)
                    <li class="comments__item user">
                        <div class="comments__avatar">
                            <a class="user__avatar-link" href="{{route('profile',$comment->user->id)}}">
                                <img class="comments__picture"
                                     src="{{asset("storage/avatars/".$comment->user->avatar)}}"
                                     alt="Аватар пользователя">
                            </a>
                        </div>
                        <div class="comments__info">
                            <div class="comments__name-wrapper">
                                <a class="comments__user-name" href="{{route('profile',$comment->user->id)}}">
                                    <span>{{$comment->user->login}}</span>
                                </a>
                                <time class="comments__time" datetime="2019-03-20">{{$comment->created_at}}
                                </time>
                            </div>
                            <p class="comments__text">
                                {{$comment->content}}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{--                <a class="comments__more-link" href="#">--}}
            {{--                    <span>Показать все комментарии</span>--}}
            {{--                    <sup class="comments__amount">45</sup>--}}
            {{--                </a>--}}
        </div>
    @endif
</div>
