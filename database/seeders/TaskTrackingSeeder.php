<?php

namespace Database\Seeders;

use App\Models\TaskTracking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskTrackingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        TaskTracking::factory(50)->create();
    }
}
