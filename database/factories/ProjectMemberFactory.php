<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectMember;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectMember::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $project = Project::inRandomOrder()->first();

        // return [
        //     'project_id' => $project->id,
        //     'user_id' => $project->owner_id,
        //     'role' => $this->faker->randomElement(['Manager', 'CEO', 'Team Lead']),
        // ];


        return [
            'project_id' => Project::inRandomOrder()->first()->id,
            'user_id' => Project::inRandomOrder()->first()->owner_id,
            'role' => fake()->jobTitle(),
        ];
        
    }
}
