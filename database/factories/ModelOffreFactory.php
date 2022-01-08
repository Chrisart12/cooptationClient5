<?php

use App\Model\Offre;

use Faker\Generator as Faker;

$factory->define(App\Model\Offre::class, function (Faker $faker) {
    return [
        'poste' => $faker->jobTitle,
        'lieu' => $faker->city,
        'reference' =>  $faker->ean13,
        'description' =>  $faker->text,
        'categorie_id' => $faker->numberBetween(1, 2),
        'user_id' => $faker->numberBetween(1, 3099),
    ];
});
