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
        <a class="post__indicator post__indicator--repost button" href="#"
           title="Репост">
            <img src="{{asset('img/icon-repost.svg')}}" class="post__indicator-icon" width="19"
                 height="17">
            <span>5</span>
            <span class="visually-hidden">количество репостов</span>
        </a>
    </div>
    <span class="post__view">500</span>
</div>
