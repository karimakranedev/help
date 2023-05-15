<?php

namespace Database\Factories;

use App\Models\ConsultationType;
use App\Models\Organisme;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsultationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'consultation_type_id' => ConsultationType::query()->inRandomOrder()->first()->id,
            'name' => $this->faker->sentence,
            'reference' => $this->faker->unique()->randomNumber(8),
            'organisme_id' => Organisme::query()->inRandomOrder()->first()->id,
            'sous_organisme' => $this->faker->optional()->company,
            'objet' => $this->faker->text,
            'ministere' => $this->faker->optional()->word,
            'classe' => $this->faker->optional()->word,
            'qualification' => $this->faker->optional()->word,
            'agreement' => $this->faker->optional()->word,
            'is_unique_lot' => $this->faker->boolean,
            'is_http_submission' => $this->faker->boolean,
            'http_submission' => $this->faker->optional()->url,
            'is_site_visit' => $this->faker->boolean,
            'execution_address' => $this->faker->optional()->address,
            'execution_city' => $this->faker->optional()->city,
            'estimation_price' => $this->faker->optional()->randomFloat(2, 1000, 10000),
            'caution' => $this->faker->optional()->randomFloat(2, 1000, 10000),
            'is_small_entity' => $this->faker->boolean,
            'pick_up_address' => $this->faker->optional()->address,
            'bid_address' => $this->faker->optional()->address,
            'bid_opening_address' => $this->faker->optional()->address,
            'plans_acquisition_price' => $this->faker->optional()->randomFloat(2, 1000, 10000),
            'montant_retrait' => $this->faker->optional()->randomFloat(2, 1000, 10000),
            'delai_execution' => $this->faker->optional()->word,
            'observation' => $this->faker->optional()->sentence,
            'date_publication' => $this->faker->optional()->date(),
            'date_ouverture' => $this->faker->optional()->date(),
            'date_reunion' => $this->faker->optional()->date(),
            'date_echantillon' => $this->faker->optional()->date(),
            'date_visite_lieux' => $this->faker->optional()->date(),
        ];
    }
}
