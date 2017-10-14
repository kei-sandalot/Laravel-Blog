<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Post;
use App\Comment;

class CommentController extends Controller
{
  public function listComment(){
    $comments = Comment::orderBy('id', 'desc')->paginate(20);
    // $this->layout->title = 'コメント一覧';
    // $this->layout->main = View::make('dash')->nest('content', 'comments.list', compact('comments'));

    $data = [
      'title' => 'コメント一覧',
      'comments' => $comments,
      'mode' => 'comment.list',
    ];

    return view('dash', $data);
  }

  public function newComment(Post $post, Request $request){
    $comment = [
      'commenter' => $request->get('commenter'),
      'email' => $request->get('email'),
      'comment' => $request->get('comment'),
    ];
    $rules = [
      'commenter' => 'required',
      'email' => 'required|email',
      'comment' => 'required',
    ];

    $valid = Validator::make($comment, $rules);
    if ($valid->passes()) {
      $comment = new Comment($comment);
      $comment->approved = 'no';
      $post->comments()->save($comment);

      return redirect()->to(request()->headers->get('referer').'#reply')->with('success', 'コメントが送信されました。現在は承認待ちです。');
    }else{
      return redirect()->to(request()->headers->get('referer').'#reply')->withErrors($valid)->withInput();
    }
  }

  public function showComment(Comment $comment, Request $request){
    if ($request->ajax()) {
      // return View::make('comments.show', compact('comment'));
      return view('comments.show', ['comment' => $comment]);
    }
  }

  public function deleteComment(Comment $comment){
    $post = $comment->post;
    $status = $comment->approved;
    $comment->delete();
    ($status === 'yes') ? $post->decrement('comment_count') : '';
    return back()->with('success', 'コメントが削除されました');
  }

  public function updateComment(Comment $comment, Request $request){
    $comment->approved = $request->get('status');
    $comment->save();
    $comment->post->comment_count = Comment::where('post_id', '=', $comment->post->id)->where('approved', '=', 1)->count();
    $comment->post->save();
    return back()->with('success', 'Comment'. (($comment->approved === 'yes') ? 'Approved' : 'Disapproved'));
  }
}
