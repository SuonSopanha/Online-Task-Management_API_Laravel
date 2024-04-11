<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeamMember>
 */
class TeamMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // adding owner to the team
        // $team = Team::inRandomOrder()->first();

        // return [
        //     'team_id' => $team->id,
        //     'user_id' => $team->owner_id,
        //     'role' => $this->faker->randomElement(['Manager', 'CEO', 'Team Lead']),
        // ];


        // adding member to the team
        return [
            'team_id' => Team::inRandomOrder()->first()->id,
            'user_id' => Team::inRandomOrder()->first()->owner_id,
            'role' => fake()->jobTitle(),
        ];
        
    }
}
