<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Goal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id',
        'goal_name',
        'description',
        'completed',
    ];

    /**
     * Get the team that owns the goal.
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
