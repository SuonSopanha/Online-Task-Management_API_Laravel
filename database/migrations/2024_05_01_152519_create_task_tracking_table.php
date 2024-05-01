<?php

// database/migrations/YYYY_MM_DD_create_task_tracking_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTrackingTable extends Migration
{
    public function up()
    {
        Schema::create('task_trackings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->unsignedInteger('duration')->nullable(); // Duration in minutes
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('task_trackings');
    }
}

