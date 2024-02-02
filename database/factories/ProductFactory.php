<?php

namespace Database\Factories;

use App\Models\User;
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
    public function definition(): array
    {
        return [
            'owner_id' => 1,
            'name' => fake()->name,
            'stage' => fake()->lastName,
            'url' => fake()->name,
            'category' => fake()->lastName,
            'description' => fake()->paragraph,
        ];
    }
}
