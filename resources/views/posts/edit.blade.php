<h2 class="edit-post">
	記事の編集
	<span class="right"><a href="/admin/post/list" class='button tiny radius'>キャンセル</a></span>
</h2>
<hr>
{{ Form::open(['route'=>['post.update', $post->id]]) }}
<div class="row">
	<div class="small-5 large-5 column">
		{{ Form::label('title','タイトル:') }}
		{{ Form::text('title', old('title', $post->title)) }}
	</div>
</div>
<div class="row">
	<div class="small-7 large-7 column">
		{{ Form::label('content','本文:') }}
		{{ Form::textarea('content', old('content', $post->content)) }}
	</div>
</div>
@foreach($errors->all() as $error)
  <div data-alert class="alert-box warning round">
  	{{$error}}
  	<a href="#" class="close">&times;</a>
  </div>
@endforeach
{{ Form::submit('更新する',['class'=>'button tiny radius']) }}
{{ Form::close() }}
