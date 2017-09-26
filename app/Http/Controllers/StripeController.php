<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function plans()
    {
    	return Plan::all();
    }
}
