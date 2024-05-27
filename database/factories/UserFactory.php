<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'company_name' => $this->faker->company(),
            'office_address' => [
                'postcode' => $this->faker->postcode(),
                'country'  => $this->faker->country(),
                'address_line_1' => $this->faker->address(),
                'address_line_2' => $this->faker->address(),
                'city' => $this->faker->city(),
                'state' => $this->faker->state(),
            ],
            'telephone' => $this->faker->phoneNumber(),
            'delivery_address' => [
                'postcode' => $this->faker->postcode(),
                'country'  => $this->faker->country(),
                'address_line_1' => $this->faker->address(),
                'address_line_2' => $this->faker->address(),
                'city' => $this->faker->city(),
                'state' => $this->faker->state(),
            ],
            'vat_number' => rand(),
            'account_person' => [
                'name' => $this->faker->name(),
                'email' => $this->faker->unique()->safeEmail(),
                'telephone' => $this->faker->phoneNumber(),
            ],
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
