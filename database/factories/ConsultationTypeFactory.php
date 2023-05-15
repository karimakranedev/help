<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ConsultationTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->word(),
            'name' => $this->faker->unique()->word(),
        ];
    }
}
