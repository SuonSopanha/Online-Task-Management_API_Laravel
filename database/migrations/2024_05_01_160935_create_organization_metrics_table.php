<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationMetricsTable extends Migration
{
    public function up()
    {
        Schema::create('organization_metrics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->integer('total_users')->default(0);
            $table->integer('active_users')->default(0);
            $table->integer('projects_created')->default(0);
            $table->integer('projects_completed')->default(0);
            $table->integer('projects_in_progress')->default(0);
            $table->decimal('average_project_completion_time', 10, 2)->default(0);
            $table->integer('total_tasks')->default(0);
            $table->integer('completed_tasks')->default(0);
            $table->integer('tasks_in_progress')->default(0);
            $table->integer('tasks_overdue')->default(0);
            $table->decimal('average_task_completion_time', 10, 2)->default(0);
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('organization_metrics');
    }
}
