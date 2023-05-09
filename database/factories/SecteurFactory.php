<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class SecteurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->uuid(),
            'name' => fake()->sentence(1)
        ];
    }
}
