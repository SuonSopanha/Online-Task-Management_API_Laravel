<?php

namespace Database\Factories;

use App\Models\Milestone;
use App\Models\Project;
use App\Models\ProjectStage;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\DateTime as DateTimeProvider;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();

        // return [
        //     'project_id' => null,
        //     'milestone_id' => null,
        //     'stage_id' => null,
        //     'owner_id' => $user->id,
        //     'on_tracking' => $this->faker->boolean,
        //     'task_name' => $this->faker->word,
        //     'description' => $this->faker->sentence,
        //     'start_date' => DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
        //     'due_date' => DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
        //     'task_category' => $this->faker->randomElement(['Category1', 'Category2', 'Category3']),
        //     'work_hour_required' => $this->faker->numberBetween(1, 100),
        //     'work_hour' => $this->faker->numberBetween(0, 100),
        //     'status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed']),
        //     'priority' => $this->faker->randomElement(['High', 'Medium', 'Low', 'Critical']),
        //     'severity' => $this->faker->randomElement(['Critical', 'Major', 'Minor']),
        //     'tag' => $this->faker->word,
        //     'assignee_id' => $user->id,
        //     'assignee_dates' => DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
        //     'complete' => $this->faker->boolean,
        //     'complete_date' => $this->faker->boolean ? DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d') : null,
        // ];

        // return [
        //     'project_id' => null,
        //     'milestone_id' => Milestone::inRandomOrder()->first()->id,
        //     'stage_id' => null,
        //     'owner_id' => $user->id,
        //     'on_tracking' => $this->faker->boolean,
        //     'task_name' => $this->faker->word,
        //     'description' => $this->faker->sentence,
        //     'start_date' => DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
        //     'due_date' => DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
        //     'task_category' => $this->faker->randomElement(['Category1', 'Category2', 'Category3']),
        //     'work_hour_required' => $this->faker->numberBetween(1, 100),
        //     'work_hour' => $this->faker->numberBetween(0, 100),
        //     'status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed']),
        //     'priority' => $this->faker->randomElement(['High', 'Medium', 'Low', 'Critical']),
        //     'severity' => $this->faker->randomElement(['Critical', 'Major', 'Minor']),
        //     'tag' => $this->faker->word,
        //     'assignee_id' => $user->id,
        //     'assignee_dates' => DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
        //     'complete' => $this->faker->boolean,
        //     'complete_date' => $this->faker->boolean ? DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d') : null,
        // ];

        // return [
        //     'project_id' => Project::inRandomOrder()->first()->id,
        //     'milestone_id' => null,
        //     'stage_id' => null,
        //     'owner_id' => User::inRandomOrder()->first()->id,
        //     'on_tracking' => $this->faker->boolean,
        //     'task_name' => $this->faker->word,
        //     'description' => $this->faker->sentence,
        //     'start_date' => DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
        //     'due_date' => DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
        //     'task_category' => $this->faker->randomElement(['Category1', 'Category2', 'Category3']),
        //     'work_hour_required' => $this->faker->numberBetween(1, 100),
        //     'work_hour' => $this->faker->numberBetween(0, 100),
        //     'status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed']),
        //     'priority' => $this->faker->randomElement(['High', 'Medium', 'Low', 'Critical']),
        //     'severity' => $this->faker->randomElement(['Critical', 'Major', 'Minor']),
        //     'tag' => $this->faker->word,
        //     'assignee_id' => User::inRandomOrder()->first()->id,
        //     'assignee_dates' => DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
        //     'complete' => $this->faker->boolean,
        //     'complete_date' => $this->faker->boolean ? DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d') : null,
        // ];

        return [
            'project_id' => Project::inRandomOrder()->first()->id,
            'milestone_id' => null,
            'stage_id' => ProjectStage::inRandomOrder()->first()->id,
            'owner_id' => User::inRandomOrder()->first()->id,
            'on_tracking' => $this->faker->boolean,
            'task_name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'start_date' => DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
            'due_date' => DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
            'task_category' => $this->faker->randomElement(['Category1', 'Category2', 'Category3']),
            'work_hour_required' => $this->faker->numberBetween(1, 100),
            'work_hour' => $this->faker->numberBetween(0, 100),
            'status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed']),
            'priority' => $this->faker->randomElement(['High', 'Medium', 'Low', 'Critical']),
            'severity' => $this->faker->randomElement(['Critical', 'Major', 'Minor']),
            'tag' => $this->faker->word,
            'assignee_id' => User::inRandomOrder()->first()->id,
            'assignee_dates' => DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
            'complete' => $this->faker->boolean,
            'complete_date' => $this->faker->boolean ? DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d') : null,
        ];
    }
}
