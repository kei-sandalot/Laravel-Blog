<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class BlogController extends Controller
{

  public function index(){
    $posts = Post::orderBy('id', 'desc')->paginate(10);

    $data = [
      'title' => 'Laravelでブログ作成',
      'posts' => $posts,
      'mode' => 'index',
      'notFound' => count($posts) == 0 ? 1 : 0,
    ];

    return view('blog', $data);
  }

  public function search(Request $request){
    $searchTerm = $request->get('s');
    $posts = Post::where('title', 'LIKE', '%'.$searchTerm.'%')->paginate(10);

    $posts->appends(['s'=>$searchTerm]);

    $data = [
      'title' => '検索：',
      'posts' => $posts,
      'mode' => 'index',
      'notFound' => count($posts) == 0 ? 1 : 0,
    ];

    return view('blog', $data);
  }
}
