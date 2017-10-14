@if($notFound == 1)
<p>記事がありません</p>
@else
@foreach($posts as $post)
    <article class="post">
        <header class="post-header">
            <h1 class="post-title">
                {{link_to_route('post.show', $post->title, $post->id)}}
            </h1>
            <div class="clearfix">
                <!-- explode ("区切り文字", "分割する文字列"); -->
                <span class="date">投稿日：{{$post->created_at}}</span>
                <span>{{$post->comment_count}}個のコメント </span>
            </div>
        </header>
        <div class="post-content">
            <p>{{$post->read_more.' ...'}}</p>
            <span>{{link_to_route('post.show', '続きを読む', $post->id)}}
        </div>
        <footer class="post-footer">
            <hr>
        </footer>
    </article>
@endforeach
{{$posts->links()}}
@endif