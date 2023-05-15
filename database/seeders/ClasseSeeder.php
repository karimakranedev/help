<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classe::create(['name'=>'Classe 1']);
        Classe::create(['name'=>'Classe 2']);
        Classe::create(['name'=>'Classe 3']);
        Classe::create(['name'=>'Classe 4']);
    }
}
