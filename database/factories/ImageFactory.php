<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
	$name = str_random(30).'.jpg';
	copy(public_path('images/factory.jpg'), storage_path('app/public/upload/'.$name));
    return [
        //'slug' => 'upload/'.$faker->image(storage_path('app/public/upload'),'100','100',null,false),
        'slug' => 'upload/'.$name
    ];
});
