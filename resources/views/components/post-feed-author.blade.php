<header class="post__header post__author">
    <a class="post__author-link" href="{{route('profile',$post->user_id)}}" title="Автор">
        <div class="post__avatar-wrapper @if($post->isRepost) post__avatar-wrapper--repost @endif">
            <img class="post__author-avatar" src="{{asset('storage/avatars/'.$post->user->avatar)}}"
                 alt="Аватар пользователя" width="60" height="60">
        </div>
        <div class="post__info">
            <b class="post__author-name">{{$post->user->login}}</b>
            <span class="post__time">{{$post->created_at}}</span>
        </div>
    </a>
</header>
