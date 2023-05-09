<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::factory()->create([
            'title' => 'Mr.',
            'first_name' => 'Karim',
            'last_name' => 'AMAKRANE',
            'email' => 'karimakrane@gmail.com',
            'phone' => '00212661452661',
            'is_super_admin' => true,
            'is_owner' => true,
            'is_active' => true,
        ]);

        Admin::factory(5)->create();
    }
}
