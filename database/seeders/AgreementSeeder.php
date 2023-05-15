<?php

namespace Database\Seeders;

use App\Models\Agreement;
use Illuminate\Database\Seeder;

class AgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agreement::create(['name' => 'Agreement 1']);
        Agreement::create(['name' => 'Agreement 2']);
        Agreement::create(['name' => 'Agreement 3']);
        Agreement::create(['name' => 'Agreement 4']);
    }
}
