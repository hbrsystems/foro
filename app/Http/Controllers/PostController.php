<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PostController extends Controller
{

    public function index(){
      $posts=Post::orderBy('created_at', 'DESC')->paginate();

//dump de un campo:     dd($posts->pluck('created_at')->toArray());

      return view('posts.index',compact('posts'));
    }

    public function show(Post $post, $slug){
//forma1:
   //    abort_unless($post->slug==$slug,404);
//forma2:
//        abort_if($post->slug!=$slug,404);
//forma3:
        if($post->slug!=$slug){
            return redirect($post->url, 301); //301 indica redir permanente
        }
        return view('posts.show', compact('post'));
    }
}
