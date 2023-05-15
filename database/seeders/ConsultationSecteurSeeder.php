<?php

namespace Database\Seeders;

use App\Models\Consultation;
use App\Models\Secteur;
use Illuminate\Database\Seeder;

class ConsultationSecteurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $consultations = Consultation::all();
        $secteurs = Secteur::all();

        foreach ($consultations as $consultation) {
            $consultation->secteurs()->attach($secteurs->random(rand(1, 3))->pluck('id')->toArray());
        }
    }
}
