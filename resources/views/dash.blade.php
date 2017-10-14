@extends('layouts.master')

@section('title', $title)

@section('content')
<div class="small-3 large-3 column">
	<aside class="sidebar">
		<h3>メニュー</h3>
		<ul class="side-nav">
			<li><a href="/">Home</a></li>
			<li class="divider"></li>
			<li class="{{ (strpos(URL::current(), route('post.new'))!== false) ? 'active' : '' }}">
				<a href="/admin/post/new">新規投稿</a>
			</li >
			<li class="{{ (strpos(URL::current(), route('post.list'))!== false) ? 'active' : '' }}">
				<a href="/admin/post/list">記事一覧</a>
			</li>
			<li class="divider"></li>
			<li class="{{ (strpos(URL::current(), route('comment.list'))!== false) ? 'active' : '' }}">
				<a href="/admin/comment/list">コメント一覧</a>
			</li>
		</ul>
	</aside>
</div>
<div class="small-9 large-9 column">
	<div class="content">
		<!-- foundationのReveal Modal pluginがajaxをサポートしています -->
		<!-- 最後のdiv要素はAjaxでコンテンツを出力しますが、これはfoundationのReveal Modal pluginが利用されています -->
		@if(Session::has('success'))
			<div data-alert class="alert-box round">
				{{Session::get('success')}}
			</div>
		@endif
		@if($mode == 'post.list')
			@include('posts.list')
		@elseif($mode == 'post.edit')
			@include('posts.edit')
		@elseif($mode == 'post.new')
			@include('posts.new')
		@elseif($mode == 'comment.list')
			@include('comments.list')
		@else
			管理パネルへようこそ<(_ _)>
		@endif
	</div>
	<div id="comment-show" class="reveal-modal small" data-reveal>
		{{-- Ajaxを利用 --}}
	</div>
</div>
@endsection