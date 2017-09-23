<?php

namespace App\Http\Controllers\Front;

use App\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function stream(Video $video)
    { if(1!=2) return 'her';
    	if($video->is_free || (auth()->user() && auth()->user()->subscribed('main'))) {
            if(app()->environment() === 'testing') return;
            $video->play();
	    }

        return response([], 404);
    }
}
