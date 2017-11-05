<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\{User, Post, Ppv};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PpvController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function store(User $user, Post $post)
    {
    	Ppv::updateOrCreate([
    		'user_id' => $user->id, 'post_id' => $post->id
    	], [
    		'ends_at' => Carbon::now()->addDay()
    	]);
    }
}
