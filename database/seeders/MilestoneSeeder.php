<?php

namespace Database\Seeders;

use App\Models\Milestone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MilestoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Milestone::factory(20)->create();
    }
}
