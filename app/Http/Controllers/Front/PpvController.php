<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\{Post, Ppv};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PpvController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function store(Post $post)
    {
    	Ppv::updateOrCreate([
    		'user_id' => auth()->id(), 'post_id' => $post->id
    	], [
    		'ends_at' => Carbon::now()->addDay()
    	]);
    }
}
