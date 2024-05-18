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

        // Ensure $assigneeDates is an array
        $assigneeDates = $task->assignee_dates;

        // Initialize date variable
        $date = $this->faker->date();

        // Check if $assigneeDates is an array and not empty
        if (is_array($assigneeDates) && !empty($assigneeDates)) {
            $startDate = $this->faker->randomElement($assigneeDates);
            $endDate = now()->format('Y-m-d');
            $date = $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d');
        }

        return [
            'task_id' => $task->id,
            'date' => $date,
            'start_time' => $this->faker->time('H:i:s'),
            'end_time' => $this->faker->time('H:i:s'),
            'duration' => $this->faker->numberBetween(1, 8), // Assuming duration in hours
        ];
    }
}
