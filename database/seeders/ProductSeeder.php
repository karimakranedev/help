<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Abonnement Annuelle',
            'description' => 'Description de l\'Abonnement Annuelle',
            'price' => 3000,
            'duration' => 12,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Abonnement deux ans',
            'description' => 'Description de l\'Abonnement de deux ans',
            'price' => 5500,
            'duration' => 24,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Abonnement trois ans',
            'description' => 'Description de l\'Abonnement de trois ans',
            'price' => 7500,
            'duration' => 36,
            'is_active' => true,
        ]);
    }
}
