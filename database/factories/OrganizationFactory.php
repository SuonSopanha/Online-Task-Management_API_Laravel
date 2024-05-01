<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = \App\Models\Organization::class;

    public function definition(): array
    {
        $industries = [
            'Information Technology',
            'Healthcare',
            'Finance',
            'Education',
            'Manufacturing',
            'Retail',
            'Hospitality',
            'Construction',
            'Transportation',
            'Media & Entertainment',
            'Telecommunications',
            'Energy',
            'Agriculture',
            'Automotive',
            'Real Estate',
            'Legal',
            'Government',
            'Non-profit',
            'Other'
        ];


        return [
            'name' => $this->faker->company,
            'description' => $this->faker->sentence,
            'industry' => $industries[array_rand($industries)],
            'owner_id' => User::inRandomOrder()->first()->id,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
