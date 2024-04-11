<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TeamMember::factory(30)->create();
    }
}
