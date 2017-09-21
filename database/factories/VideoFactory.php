<?php

use Faker\Generator as Faker;

$factory->define(App\Video::class, function (Faker $faker) {
	$name = str_random(30).'.jpg';
	copy(public_path('images/factory.jpg'), storage_path('app/public/video/'.$name));
    $post = factory('App\Post')->create();
    return [
        'post_id' => $post->id,
        'slug' => $post->slug.'-1',
        //'link' => 'video/'.$faker->image(storage_path('app/public/video'),'100','100',null,false),
        'link' => 'video/'.$name
    ];
});
