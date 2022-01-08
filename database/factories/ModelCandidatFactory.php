
<?php

use App\Model\Offre;
use Faker\Generator as Faker;

$factory->define(App\Model\Candidat::class, function (Faker $faker) {
    return [
        "user_id" => 1,
        "job_id" => 1,
        'step_id' => 1,
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
        // 'institution'  => function () {
        //     return factory(App\Model\Offre::class)->create()->reference;
        //     //return Offre::all()->random();
        // },
        // 'departement' => function () {
        //    // return factory(App\Model\Offre::class)->create()->id;
        //    return Offre::all()->random();
        // },
    ];
});

// use App\Model\Offre;
// use Faker\Generator as Faker;

// $factory->define(App\Model\Candidat::class, function (Faker $faker) {
//     return [
//         'firstname' => $faker->firstName,
//         'lastname' => $faker->lastName,
//         'poste' =>  $faker->jobTitle,
//         //'reference' =>  $faker->ean13,
//         'reference'  => function () {
//              return factory(App\Model\Offre::class)->create()->reference;
//             //return Offre::all()->random();
//          },
//         'offre_id' => function () {
//            // return factory(App\Model\Offre::class)->create()->id;
//            return Offre::all()->random();
//         },
//     ];
// });

