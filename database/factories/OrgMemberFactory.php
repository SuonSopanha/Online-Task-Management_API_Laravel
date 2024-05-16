<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\OrgMember;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrgMemberFactory extends Factory
{
    protected $model = OrgMember::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'org_id' => OrgMember::inRandomOrder()->first()->id,
            'role' => $this->faker->jobTitle, // Customize role as needed
            'is_admin' => $this->faker->boolean,
        ];
    }
}
