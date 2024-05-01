<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'total_users',
        'active_users',
        'projects_created',
        'projects_completed',
        'projects_in_progress',
        'average_project_completion_time',
        'total_tasks',
        'completed_tasks',
        'tasks_in_progress',
        'tasks_overdue',
        'average_task_completion_time',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
