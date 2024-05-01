<?php

namespace Database\Factories;

use App\Models\OrgMember;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrgMemberFactory extends Factory
{
    protected $model = OrgMember::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'org_id' => \App\Models\Organization::factory(),
            'role' => $this->faker->jobTitle, // Customize role as needed
            'is_admin' => $this->faker->boolean,
        ];
    }
}
