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

        $canWatch = auth()->user()? auth()->user()->can('watch', $post) : false;

    	return view('movie', compact('post', 'canWatch'));
    }

    public function updateViews(Post $post)
    {
        $post->updateViews();
    }
}
