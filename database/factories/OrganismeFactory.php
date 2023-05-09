<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class OrganismeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'email' => fake()->companyEmail(),
            'phone_1'=> fake()->phoneNumber(),
            'phone_2'=> fake()->phoneNumber(),
            'fax'=> fake()->phoneNumber(),
            'website'=> fake()->domainName(),
            'street' => fake()->streetAddress(),
            'city' => fake()->city(),
            'type' => fake()->randomElement(['Public','Semi-Public','Privé','Association','ONG']),
            'zip' => fake()->postcode(),
            'country' => fake()->country()
        ];
    }
}
