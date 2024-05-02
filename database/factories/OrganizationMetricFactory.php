<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrganizationMetric>
 */
class OrganizationMetricFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = \App\Models\OrganizationMetric::class;
    public function definition(): array
    {
        return [
            'organization_id' => Organization::inRandomOrder()->first()->id,
            'total_users' => $this->faker->numberBetween(0, 100),
            'active_users' => $this->faker->numberBetween(0, 100),
            'projects_created' => $this->faker->numberBetween(0, 50),
            'projects_completed' => $this->faker->numberBetween(0, 50),
            'projects_in_progress' => $this->faker->numberBetween(0, 50),
            'average_project_completion_time' => $this->faker->randomFloat(2, 0, 100),
            'total_tasks' => $this->faker->numberBetween(0, 500),
            'completed_tasks' => $this->faker->numberBetween(0, 500),
            'tasks_in_progress' => $this->faker->numberBetween(0, 500),
            'tasks_overdue' => $this->faker->numberBetween(0, 500),
            'average_task_completion_time' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
