<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'title' => 'Mr.',
            'first_name' => 'Khaoula',
            'last_name' => 'MEDKOURI',
            'email' => 'medkouri@gmail.com',
            'phone' => '00212661119332',
            'is_owner' => true,
            'is_active' => true,
            'company_id' => 1,
        ]);
    }
}
