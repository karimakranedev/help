<?php

namespace Database\Seeders;

use App\Models\Otype;
use Illuminate\Database\Seeder;

class OtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Otype::create(['name' => 'Public']);
        Otype::create(['name' => 'Semi-Public']);
        Otype::create(['name' => 'Privé']);
        Otype::create(['name' => 'Association']);
        Otype::create(['name' => 'ONG']);
    }
}
