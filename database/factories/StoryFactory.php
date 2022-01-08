<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Story::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\Model\User::class)->create();
        },
        'story' => $faker->sentences($nbWords = 3, $variableNbWords = true),
        'picture_path' => $faker->imageUrl($width = 640, $height = 480),
        'bg_position_x' => $faker->numberBetween(1, 100),
        'bg_position_y' => $faker->numberBetween(1, 100),
        'is_active' => 1,
        'is_done' => 1,
        'is_demo' => 1,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ];
});
