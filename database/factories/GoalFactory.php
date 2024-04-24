<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Goal>
 */
class GoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'goal_name' => fake()->word(),
            'description' => fake()->paragraph(),
            'team_id' => User::inRandomOrder()->first()->id,
            'completed' => fake()->boolean(),
        ];
    }
}
