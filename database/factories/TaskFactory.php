<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => null,
            'milestone_id' => null,
            'owner_id' => $this->faker->randomNumber(),
            'tracking_id' => null,
            'task_name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'start_date' => $this->faker->date(),
            'due_date' => $this->faker->date(),
            'task_category' => $this->faker->word(),
            'work_hour_required' => $this->faker->numberBetween(1, 100),
            'work_hour' => 0,
            'status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed']),
            'priority' => $this->faker->randomElement(['Low', 'Medium', 'High', 'Critical']),
            'severity' => $this->faker->randomElement(['Low', 'Medium', 'High', 'Critical']),
            'tag' => $this->faker->word(),
            'assignee_id' => null,
            'assignee_dates' => $this->faker->date(),
            'complete' => false,
            'complete_date' => null,
        ];
    }
}
