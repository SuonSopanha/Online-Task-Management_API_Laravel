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
        'owner_id',
    ];

    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }
}
