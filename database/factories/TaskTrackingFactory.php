<?php

// database/factories/TaskTrackingFactory.php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskTracking;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskTrackingFactory extends Factory
{
    protected $model = TaskTracking::class;

    public function definition()
    {
        // Get a random task
        $task = Task::inRandomOrder()->first();

        // Get the assignee dates array from the task
        $assigneeDates = $task->assignee_dates;

        // If the assignee dates array is not empty, get a random date within the range
        // Otherwise, use a random date generated by Faker
        if (!empty($assigneeDates)) {
            $startDate = $this->faker->randomElement($assigneeDates);
            $endDate = now()->format('Y-m-d');
            $date = $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d');
        } else {
            $date = $this->faker->date();
        }

        return [
            'task_id' => $task->id,
            'date' => $date,
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'duration' => $this->faker->numberBetween(1, 8), // Assuming duration in hours
        ];
    }
}