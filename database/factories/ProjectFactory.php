<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_name' => $this->faker->sentence,
            'owner_id' => User::inRandomOrder()->first()->id,
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'team_id' => null,
            'project_status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed']),
            'project_priority' => $this->faker->randomElement(['High', 'Medium', 'Low', 'Critical']),
        ];

        // return [
        //     'project_name' => $this->faker->sentence,
        //     'owner_id' => 14,
        //     'start_date' => $this->faker->date(),
        //     'end_date' => $this->faker->date(),
        //     'team_id' => 4,
        //     'project_status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed']),
        //     'project_priority' => $this->faker->randomElement(['High', 'Medium', 'Low', 'Critical']),
        // ];
    }
}
