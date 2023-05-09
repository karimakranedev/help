<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory()->create([
            'name' => 'Alyae EDUCATION',
            'email' => 'info@emmipikler.ma',
            'phone' => '0661102575',
            'founded_year' => '2013',
            'is_active' => '1',
        ]);
    }
}
