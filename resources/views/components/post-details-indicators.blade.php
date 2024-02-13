<div class="post__indicators">
    <div class="post__buttons">
        <form class="" action="{{route('like',$post->id)}}" title="Лайк" method="post">
            @csrf
            @method('post')
            <button class="post__indicator post__indicator--likes button" type="submit">
                @if(auth()->user()->likes($post->id)->exists())
                    <img src="{{asset('img/icon-heart-active.svg')}}" class="post__indicator-icon" width="20"
                         height="17">
                @else
                    <img src="{{asset('img/icon-heart.svg')}}" class="post__indicator-icon" width="20"
                         height="17">
                @endif
                <span>{{$post->likes()->count()}}</span>
                <span class="visually-hidden">количество лайков</span>
            </button>
        </form>
        <a class="post__indicator post__indicator--comments button" href="{{route('show_post',$post->id)}}"
           title="Комментарии">
            <img src="{{asset('img/icon-comment.svg')}}" class="post__indicator-icon" width="19"
                 height="17">
            <span>{{$post->comments()->count()}}</span>
            <span class="visually-hidden">количество комментариев</span>
        </a>
        @if(auth()->user()->id !== $post->user_id)
            <form action="{{route('repost',$post->id)}}" method="post">
                @csrf
                @method('post')
                <button type="submit" class="post__indicator post__indicator--repost button"
                        title="Репост">
                    <img src="{{asset('img/icon-repost.svg')}}" class="post__indicator-icon" width="19"
                         height="17">
                    <span>0</span>
                    <span class="visually-hidden">количество репостов</span>
                </button>
            </form>
        @else
            <button type="submit" class="post__indicator post__indicator--repost button"
                    title="Репост">
                <img src="{{asset('img/icon-repost.svg')}}" class="post__indicator-icon" width="19"
                     height="17">
                <span>0</span>
                <span class="visually-hidden">количество репостов</span>
            </button>
        @endif
    </div>

    <span class="post__view">500</span>
</div>
