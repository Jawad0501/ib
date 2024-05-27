<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'        => fake()->sentence(),
            'sku_number'  => rand(1111, 99999),
            'ur_code'     => fake()->sentence(),
            'unit_price'  => rand(20, 100),
            'setup_price' => rand(20, 100),
            'vat'         => ['yes','no'][rand(0,1)],
            'vat_percentage'  => 20
        ];
    }
}
