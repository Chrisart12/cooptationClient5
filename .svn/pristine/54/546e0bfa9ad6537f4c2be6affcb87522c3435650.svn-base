<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ["label" => "Superadministrateur", "slug" => "super_admin"],
            ["label" => "Administrateur", "slug" => "admin"],
            ["label" => "Collaborateur", "slug" => "collaborator"],
        ]);
    }
}
