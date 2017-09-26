<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
    	return view('settings.index');
    }

    public function updateAccount(Request $request)
    {
    	$this->validate($request, [
            'name' => 'required|string|max:255|unique:users,name,'.auth()->id().'id',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id().'id',
            'password' => $request->password ? 'string|min:6|confirmed' : ''
        ]);

    	tap(auth()->user(), function($user) use($request) {
    		$user->name = $request->name;
    		$user->email = $request->email;
    		if($request->password) {
    			$user->password = bcrypt($request->password);
    		}
    		$user->save();
    	});

        return back();
    }
}
