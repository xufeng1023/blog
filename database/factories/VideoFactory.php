<?php

use Faker\Generator as Faker;

$factory->define(App\Video::class, function (Faker $faker) {
    $post = factory('App\Post')->create();
    return [
        'post_id' => $post->id,
        'slug' => $post->slug.'-1',
        'link' => 'video/'.$faker->image(storage_path('app/public/video'),'640','480',null,false),
    ];
});
