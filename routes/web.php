<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'BlogController@index');
Route::get('/search', 'BlogController@search')->name('search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ユーザーのルート設定
Route::get('/post/{post}/show', 'PostController@showPost')->name('post.show');
Route::post('/post/{post}/comment', 'CommentController@newComment')->name('comment.new');

// アドミンのルート設定
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){

  // ルートの取得
  Route::get('/', function(){
    return view('dash', [
      'title' => '管理パネル',
      'mode' => 'dashboard',
    ]);
  });

  Route::get('/post/list', 'PostController@listPost')->name('post.list');
  Route::get('/post/new', 'PostController@newPost')->name('post.new');

  Route::get('/post/{post}/edit', 'PostController@editPost')->name('post.edit');
  Route::get('/post/{post}/delete', 'PostController@deletePost')->name('post.delete');

  Route::get('/comment/list', 'CommentController@listComment')->name('comment.list');
  Route::get('/comment/{comment}/show', 'CommentController@showComment')->name('comment.show');
  Route::get('/comment/{comment}/delete', 'CommentController@deleteComment')->name('comment.delete');

  // 投稿のルート設定
  Route::post('/post/save', 'PostController@savePost')->name('post.save');
  Route::post('/post/{post}/update', 'PostController@updatePost')->name('post.update');
  Route::post('/comment/{comment}/update', 'CommentController@updateComment')->name('comment.update');

});

// ビューコンポーサー
// サイドバーに最近の投稿を表示するためのルーティング
View::composer('sidebar', function ($view) {
    $view->recentPosts = \App\Post::orderBy('id', 'desc')->take(5)->get();
});
