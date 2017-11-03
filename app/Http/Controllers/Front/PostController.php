<?php

namespace App\Http\Controllers\Front;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
    	$posts = Post::latest()->paginate(16);

    	return view('movies', compact('posts'));
    }

    public function show(Post $post)
    {
        if(app()->environment() === 'testing') {
            return [$post, $post->preview];
        }

    	return view('movie', compact('post'));
    }

    public function updateViews(Post $post)
    {
        $post->updateViews();
    }
}
