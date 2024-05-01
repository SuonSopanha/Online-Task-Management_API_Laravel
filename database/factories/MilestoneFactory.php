<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Milestone;
use Faker\Provider\DateTime as DateTimeProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class MilestoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Milestone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'milestone_name' => $this->faker->sentence,
            'start_date' => DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
            'end_date' => DateTimeProvider::dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
            'owner_id' => User::inRandomOrder()->first()->id
        ];
    }
}
