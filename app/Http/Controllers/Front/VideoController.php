<?php

namespace App\Http\Controllers\Front;

use App\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function stream(Video $video)
    {
    	if($video->is_free || (auth()->user() && auth()->user()->subscribed('main'))) {
            if(app()->environment() === 'testing') return;
            $video->play();
	    }

        return response([], 404);
    }

    public function checkSlug(Video $video)
    {
        if($video->is_free) return $video->slug;
        
        if(!auth()->user()) return response(__('index.need to login'), 401);

        if(!auth()->user()->subscribed('main')) return response(__('index.expired'), 402);

        return $video->slug;
    }
}
