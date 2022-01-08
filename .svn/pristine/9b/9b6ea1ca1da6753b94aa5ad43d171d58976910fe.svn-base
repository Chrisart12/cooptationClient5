<?php

use Illuminate\Database\Seeder;

class StorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // On fait une boucle pour remplir la base de données des user_id qui sont dans la table users
        for ($i = 1; $i <= 3789; $i++) {

            DB::table('stories')->insert([
                ["user_id" => $i],
            ]);
        }
    }
}
