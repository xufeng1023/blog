<?php

namespace App;

use Stripe\{Plan};
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public function plans()
    {
    	return Plan::all();
    }
}
