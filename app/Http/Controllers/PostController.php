<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Post;

class PostController extends Controller
{
  public function listPost(){
    // AuthユーザーIDを取得する
    $id = \Auth::user()->id;

    // ユーザーIDとauthorIDの等しい記事を取得する
    // $posts = Post::where('author_id', '=', $id)->get();
    $posts = Post::orderBy('id', 'desc')->paginate(10);

    $data = [
      'title' => '投稿一覧',
      'posts' => $posts,
      'mode' => 'post.list',
    ];

    return view('dash', $data);
  }

  // ※ルートとモデルの結合：解説あり
  public function showPost(Post $post){
    $comments = $post->comments()->where('approved', '=', 1)->get();

    $data = [
      'title' => $post->title,
      'post' => $post,
      'comments' => $comments,
      'mode' => 'post.single',
    ];

    return view('blog', $data);
  }

  public function newPost(){
    $data = [
      'title' => '新規投稿',
      'mode' => 'post.new',
    ];

    return view('dash', $data);
  }

  public function editPost(Post $post){
    $data = [
      'title' => '記事の編集',
      'post' => $post,
      'mode' => 'post.edit',
    ];

    return view('dash', $data);
  }

  public function deletePost(Post $post){
    $post->delete();
    return redirect()->route('post.list')->with('success', '記事が削除されました');
  }

  public function savePost(Request $request){
    $post = [
      'title' => $request->get('title'),
      'content' => $request->get('content'),
    ];

    $rules = [
      'title' => 'required',
      'content' => 'required',
    ];

    $valid = Validator::make($post, $rules);
    if ($valid->passes()) {
      $post = new Post($post);
      $post->author_id = \Auth::user()->id;
      $post->comment_count = 0;
      $post->read_more = (strlen($post->content) > 120) ? substr($post->content, 0, 120) : $post->content;
      $post->save();
      return redirect()->route('post.list')->with('success', '投稿が保存されました');
    }else{
      return back()->withErrors($valid)->withInput();
    }
  }

  public function updatePost(Post $post, Request $request){
    $data = [
      'title' => $request->get('title'),
      'content' => $request->get('content'),
    ];

    $rules = [
      'title' => 'required',
      'content' => 'required',
    ];

    $valid = Validator::make($data, $rules);
    if ($valid->passes()) {
      $post->title = $data['title'];
      $post->content = $data['content'];
      $post->read_more = (strlen($post->content) > 120) ? substr($post->content, 0, 120) : $post->content;

      // 同じ投稿を再度送信することを避ける
      // getDirty：Get the attributes that have been changed since last sync.
      if (count($post->getDirty()) > 0) {
        $post->save();
        return back()->with('success', '投稿が更新されました');
      }else{
        return back()->with('success', '更新内容がありません');
      }
    }else{
      return back()->withErrors($valid)->withInput();
    }
  }
}
