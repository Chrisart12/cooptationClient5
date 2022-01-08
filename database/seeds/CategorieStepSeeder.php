<?php

use Illuminate\Database\Seeder;

class CategorieStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorie_step')->insert([
            ["step_id" => 1, "categorie_id" => 1, "ordre" => 1],
            ["step_id" => 10, "categorie_id" => 1, "ordre" => 2],
            ["step_id" => 4, "categorie_id" => 1, "ordre" => 3],
            ["step_id" => 11, "categorie_id" => 1, "ordre" => 4],
            ["step_id" => 7, "categorie_id" => 1, "ordre" => 5],
            ["step_id" => 1, "categorie_id" => 2, "ordre" => 1],
            ["step_id" => 2, "categorie_id" => 2, "ordre" => 2],
            ["step_id" => 3, "categorie_id" => 2, "ordre" => 3],
            ["step_id" => 4, "categorie_id" => 2, "ordre" => 4],
            ["step_id" => 5, "categorie_id" => 2, "ordre" => 5],
            ["step_id" => 6, "categorie_id" => 2, "ordre" => 6],
            ["step_id" => 7, "categorie_id" => 2, "ordre" => 7],
            ["step_id" => 8, "categorie_id" => 2, "ordre" => 8],
            
        ]);
    }
}
