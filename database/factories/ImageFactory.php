<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'slug' => 'upload/'.$faker->image(storage_path('app/public/upload'),'640','480',null,false),
    ];
});
