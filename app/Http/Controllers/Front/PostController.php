<?php

namespace App\Http\Controllers\Front;

use App\Post;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        if(request()->wantsJson()) {
            return Post::with('images')->latest()->paginate(8);
        }
    	
    	return view('movies');
    }

    public function show(Post $post)
    {
        $post->append(['thumbnail', 'preview']);

    	return view('movie', compact('post'));
    }

    public function updateViews(Post $post)
    {
        $post->updateViews();
    }
}
