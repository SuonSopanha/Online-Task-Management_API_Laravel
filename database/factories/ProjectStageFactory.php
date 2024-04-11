<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectStage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectStageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectStage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => Project::inRandomOrder()->first()->id,
            'stage_name' => $this->faker->word,
            'start_date' => $this->faker->date(),
            'period' => $this->faker->numberBetween(1, 30), // Assuming period is in days
            'end_date' => $this->faker->date(),
            'completed' => $this->faker->boolean,
            'completion_date' => $this->faker->boolean ? $this->faker->date() : null,
        ];
    }
}
