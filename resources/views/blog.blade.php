@extends('layouts.master')

@section('title', $title)

@section('content')
{{-- home page --}}
<div class="small-8 large-8 column">
  <div class="content">
    @if($mode == 'post.single')
      @include('posts.single')
    @elseif($mode == 'index')
      @include('index')
    @endif
  </div>
</div>
<div class="small-4 large-4 column">
  <aside class="sidebar">
    @include('sidebar')
  </aside>
</div>
@endsection
