<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'milestone_id',
        'stage_id',
        'owner_id',
        'on_tracking',
        'task_name',
        'description',
        'start_date',
        'due_date',
        'task_category',
        'work_hour_required',
        'work_hour',
        'status',
        'priority',
        'severity',
        'tag',
        'assignee_id',
        'assignee_dates',
        'complete',
        'complete_date',
    ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'due_date' => 'date:Y-m-d',
        'assignee_dates' => 'date:Y-m-d',
        'complete_date' => 'date:Y-m-d',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function milestone()
    {
        return $this->belongsTo(Milestone::class);
    }

    public function stage()
    {
        return $this->belongsTo(ProjectStage::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }
}
