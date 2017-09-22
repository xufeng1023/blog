<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Subscription::class, function (Faker $faker) {
	$plan = $faker->word;
    return [
        'user_id' => factory('App\User')->create()->id,
        'name' => $plan,
        'stripe_id' => 'sub_'.str_random(14),
        'stripe_plan' => $plan,
        'quantity' => 1,
        'ends_at' => Carbon::now()->addDay()
    ];
});
