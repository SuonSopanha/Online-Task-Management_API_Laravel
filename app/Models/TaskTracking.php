<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'date',
        'start_time',
        'end_time',
        'duration',
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'time',
        'end_time' => 'time',
        'duration' => 'integer',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

}
