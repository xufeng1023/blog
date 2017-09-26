<?php

use Faker\Generator as Faker;

$factory->define(App\Plan::class, function (Faker $faker) {
    return [
        'plan_id' => substr($faker->word, 0, 6),
        'name' => substr($faker->word, 0 ,6),
        'price' => 15.00
    ];
});
