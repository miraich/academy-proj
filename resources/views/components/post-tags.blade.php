<ul class="post__tags">
    @foreach($post->tags as $tag)
        <li><a href="{{route('search_by_tag_or_content','search_content='.urlencode('#').$tag->name)}}">{{"#".$tag->name}}</a></li>
    @endforeach
</ul>
