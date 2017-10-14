<h2 class="new-post">
	新規記事の作成
	<span class="right"><a href="/admin/post/list" class='button tiny radius'>キャンセル</a></span>
</h2>
<hr>
{{ Form::open(['route'=>'post.save']) }}
<div class="row">
	<div class="small-5 large-5 column">
		{{ Form::label('title', 'タイトル:') }}
		{{ Form::text('title', old('title')) }}
	</div>
</div>
<div class="row">
	<div class="small-7 large-7 column">
		{{ Form::label('content', '内容:') }}
		{{ Form::textarea('content', old('content'),['rows'=>5]) }}
	</div>
</div>
@foreach($errors->all() as $error)
<div data-alert class="alert-box warning round">
	{{$error}}
	<a href="#" class="close">&times;</a>
</div>
@endforeach
{{ Form::submit('セーブする', ['class'=>'button tiny radius']) }}
{{ Form::close() }}
