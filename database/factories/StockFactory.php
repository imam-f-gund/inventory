<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product = Product::inRandomOrder()->first();
        $type = $this->faker->randomElement(['in', 'out']);

        if ($product->qty < 10 && $type == 'out') {
            $type = 'in';
        }

        $qty = $type === 'in' ? $this->faker->numberBetween(1, 10) : $this->faker->numberBetween(-10, -1);

        $product->qty += $qty;
        $product->save();

        return [
            'product_id' => $product->id,
            'qty' => $qty,
            'date' => $this->faker->date,
            'type' => $type,
            'note' => $this->faker->text,
        ];
    }
}
