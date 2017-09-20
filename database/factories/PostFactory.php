<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'title' => ucwords($title),
        'slug' => str_slug($title, '-')
    ];
});
