<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'milestone_name',
        'start_date',
        'end_date',
    ];

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
