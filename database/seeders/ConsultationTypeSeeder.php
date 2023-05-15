<?php

namespace Database\Seeders;

use App\Models\ConsultationType;
use Illuminate\Database\Seeder;

class ConsultationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConsultationType::create(['name' => 'Appel d\'offre ouvert', "code" =>'AO']);
        ConsultationType::create(['name' => 'Appel d\'offre restraint', "code" =>'AOR']);
        ConsultationType::create(['name' => 'Marchés sur concours', "code" =>'MC']);
        ConsultationType::create(['name' => 'Marchés négocié', "code" =>'MN']);
        ConsultationType::create(['name' => 'Bon de commande', "code" =>'BC']);
    }
}
