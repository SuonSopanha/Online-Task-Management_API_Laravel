<?php

namespace App\Models;

use App\Models\User;
use App\Models\ProjectStage;
use App\Models\ProjectMember;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'owner_id',
        'start_date',
        'end_date',
        'team_id',
        'project_status',
        'project_priority',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function stages()
    {
        return $this->hasMany(ProjectStage::class, 'project_id');
    }

    public function project_members()
    {
        return $this->hasMany(ProjectMember::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
