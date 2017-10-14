<h2 class="post-listings">記事一覧</h2><hr>
<table>
    <thead>
    <tr>
        <th width="300">タイトル</th>
        <th width="120">編集</th>
        <th width="120">削除</th>
        <th width="120">閲覧</th>
    </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{$post->title}}</td>
                <td><a href="/admin/post/{{$post->id}}/edit">Edit</a></td>
                <td><a href="/admin/post/{{$post->id}}/delete">Delete</a></td>
                <td><a href="/post/{{$post->id}}/show" target="_blank">Show</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
{{$posts->links()}}