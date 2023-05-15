<?php

namespace Database\Seeders;

use App\Models\Stype;
use Illuminate\Database\Seeder;

class StypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stype::create(['name' => 'Traveaux']);
        Stype::create(['name' => 'Prestations']);
        Stype::create(['name' => 'Fournitures']);
        Stype::create(['name' => 'Etudes']);

    }
}
