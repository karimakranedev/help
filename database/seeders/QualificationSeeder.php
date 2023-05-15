<?php

namespace Database\Seeders;

use App\Models\Qualification;
use Illuminate\Database\Seeder;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Qualification::create(['name' => 'Qualification 1']);
        Qualification::create(['name' => 'Qualification 2']);
        Qualification::create(['name' => 'Qualification 3']);
        Qualification::create(['name' => 'Qualification 4']);
        Qualification::create(['name' => 'Qualification 5']);
    }
}
