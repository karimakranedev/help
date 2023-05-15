<?php

namespace Database\Seeders;

use App\Models\Secteur;
use File;
use Illuminate\Database\Seeder;

class SecteurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Sector::truncate();
        $json = File::get("database/data/secteurs.json");
        $sectors = json_decode($json);

        foreach ($sectors as $sector) {
            Secteur::create([
                "name" => $sector->name,
                "code" => $sector->code,
                "type" => $sector->type
            ]);
        }
    }
}
