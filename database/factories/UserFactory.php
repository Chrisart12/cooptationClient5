<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Model\User::class, function (Faker $faker) {
    return [
        'region_id' => function () {
            return factory(App\Model\Region::class)->create();
        },
        'responsible_id' => function () {
            return factory(App\Model\Responsible::class)->create();
        },
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'job' => $faker->jobTitle,
        'institution' =>$faker->company,
        'departement' => $faker->city,
        'email' => $faker->unique()->safeEmail,
        'token' => Str::random(40),
        'verify_email_token' => Str::random(40),
        'password' => $faker->sha256,
        'remember_token' => str_random(10),
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
        
    ];
});


// use Faker\Generator as Faker;

// /*
// |--------------------------------------------------------------------------
// | Model Factories
// |--------------------------------------------------------------------------
// |
// | This directory should contain each of the model factory definitions for
// | your application. Factories provide a convenient way to generate new
// | model instances for testing / seeding your application's database.
// |
// */

// $factory->define(App\User::class, function (Faker $faker) {
//     return [
//         'firstname' => $faker->firstName,
//         'lastname' => $faker->lastName,
//         'job' => $faker->jobTitle,
//         'institution' =>$faker->company,
//         'region_id' => $faker->numberBetween(1, 30),
//         'responsable_id' => $faker->numberBetween(1, 100),
//         'email' => $faker->unique()->safeEmail,
//         //'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
//         'password' => $faker->sha256,
//         'remember_token' => str_random(10),
//     ];
// });

