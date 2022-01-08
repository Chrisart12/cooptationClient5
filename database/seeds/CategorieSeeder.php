<?php

use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ["slug" => "cadre", "label" => "Cadre"],
            ["slug" => "employe", "label" => "Employé"],
        ]);
    }
}
