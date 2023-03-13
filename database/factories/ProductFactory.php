<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(100, 1000),
            'stock' => $this->faker->numberBetween(0, 100),
            'is_new' => $this->faker->boolean(),
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
