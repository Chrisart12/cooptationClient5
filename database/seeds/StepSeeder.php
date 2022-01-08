<?php

use Illuminate\Database\Seeder;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('steps')->insert([
            ["step_number" => 1, "slug" => "proposition", "label" => "Proposition", "note" => 0],
            ["step_number" => 2, "slug" => "rendez_vous_1", "label" => "Rendez-vous-1", "note" => 5],
            ["step_number" => 3, "slug" => "rendez_vous_2", "label" => "Rendez-vous-2", "note" => 5],
            ["step_number" => 4, "slug" => "integration", "label" => "Integration", "note" => 10],
            ["step_number" => 5, "slug" => "essai_1", "label" =>  "Essai-1", "note" => 20],
            ["step_number" => 6, "slug" => "essai_2", "label" => "Essai-2", "note" => 30],
            ["step_number" => 7, "slug" => "cdi", "label" => "CDI", "note" => 50],
            ["step_number" => 8, "slug" => "six_mois", "label" => "Six-mois", "note" => 100],
            ["step_number" => 9, "slug" => "fin_etapes", "label" => "Fin-étapes", "note" => 0],
            ["step_number" => 10, "slug" => "rendez_vous", "label" => "Rendez-vous", "note" => 10],
            ["step_number" => 11, "slug" => "essai", "label" => "Essai", "note" => 50],
        ]);
    }
}
