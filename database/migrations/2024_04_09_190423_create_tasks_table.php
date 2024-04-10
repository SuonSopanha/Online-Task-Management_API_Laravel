<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('milestone_id')->nullable();
            $table->unsignedBigInteger('stage_id')->nullable();
            $table->unsignedBigInteger('owner_id');
            $table->boolean('on_tracking')->default(false);
            $table->string('task_name', 255);
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('due_date');
            $table->string('task_category', 255);
            $table->integer('work_hour_required');
            $table->integer('work_hour')->default(0);
            $table->string('status', 255);
            $table->string('priority', 255);
            $table->string('severity', 255);
            $table->string('tag', 255)->nullable();
            $table->unsignedBigInteger('assignee_id')->nullable();
            $table->date('assignee_dates');
            $table->boolean('complete')->default(false);
            $table->date('complete_date')->nullable();
            $table->timestamps();


            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('milestone_id')->references('id')->on('milestones')->onDelete('cascade');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assignee_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('stage_id')->references('id')->on('project_stages')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
