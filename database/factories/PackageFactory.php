<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'name' => fake()->name,
            'price' => fake()->randomDigit,
            'monthly_rate' => fake()->randomDigit,
            'annual_rate' => fake()->randomDigit,
            'subscription_type' => fake()->lastName,
            'features' => fake()->paragraph,
            'product_limit' => fake()->dateTime,
            'validity' => fake()->dateTime,
            'has_limited_features' => fake()->paragraph,
            'is_popular' => 1,
        ];
    }
}
