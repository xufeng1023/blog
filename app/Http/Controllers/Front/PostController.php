<?php

namespace App\Http\Controllers\Front;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
    	$posts = Post::with(['images' => function($query) {
    		$query->where('is_thumbnail', 1);
    	}])->latest()->paginate(20);

    	return view('movies', compact('posts'));
    }

    public function show(Post $post)
    {
    	$post->load(['images', 'videos.thumbnail']);

        $preview = $post->getPreview();

        if(app()->environment() === 'testing') {
            return [$post, $preview];
        }
    	return view('movie', compact('post', 'preview'));
    }
}
