<?php

use App\User;
use Faker\Generator as Faker;


$factory->define(App\Model\Story::class, function (Faker $faker) {
   // $filePath = public_path('storage/images');
    return [
        'story' => $faker->text,
        'picture_path' => 'story14.jpg', 
        'is_active' => $faker->numberBetween(0, 1),
        'is_done' =>  $faker->numberBetween(0, 1),
        'is_demo' => $faker->numberBetween(0, 1),
        'user_id'  => function () {
             //return factory(App\User::class)->create()->id;
             return User::all()->random();
         },
    ];
});
