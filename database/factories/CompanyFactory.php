<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'founded_year' => $this->faker->year(),
            'website' => $this->faker->url(),
            'linkedin' => 'linkedin',
            'facebook' => 'facebook',
            'patente' => $this->faker->randomNumber(4,true),
            'if' => $this->faker->randomNumber(6,true),
            'rc' => $this->faker->randomNumber(6,true),
            'ice' => $this->faker->randomNumber(7,true),
            'cnss' => $this->faker->randomNumber(7,true),
            'country' => $this->faker->country(),
            'street' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
