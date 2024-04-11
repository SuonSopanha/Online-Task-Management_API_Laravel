<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'stage_name',
        'start_date',
        'period',
        'end_date',
        'completed',
        'completion_date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
