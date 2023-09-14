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
            'product_name' => $this->faker->name,
            'brand' => $this->faker->name,
            'date_input' => $this->faker->date,
            'qty' => $this->faker->numberBetween(500, 1000),
            'price' => $this->faker->numberBetween(10, 100),
            'selling_price' => $this->faker->numberBetween(20, 100),
            'category_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
