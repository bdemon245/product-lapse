<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => function(){
                return User::inRandomOrder()->first()->id;
            },
            'creator_id' => function(){
                return User::inRandomOrder()->first()->id;
            },
            'name' => fake()->name,
            'type' => fake()->randomElement(['PDF', 'Image']),
            'report_date' => fake()->time,
            'description' => fake()->paragraph,
        ];
    }
}
