<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discounts = [
            [
                'name' => 'Réduction de 10%',
                'description' => 'Réduction de 10% sur toutes les abonnements',
                'discount_percentage' => 10,
                'start_date' => now(),
                'end_date' => now()->addMonth(),
                'is_forced' => false,
            ],
            [
                'name' => 'Réduction de 20%',
                'description' => 'Réduction de 20% sur les abonnements annuels',
                'discount_percentage' => 20,
                'start_date' => now(),
                'end_date' => now()->addMonth(),
                'is_forced' => false,
            ],
        ];

        foreach ($discounts as $discount) {
            Discount::create($discount);
        }
    }
}
