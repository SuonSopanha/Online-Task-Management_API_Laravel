<?php

namespace App\Models;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'owner_id'];

    // Define the relationship with the User model
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function goals(){
        return $this->hasMany(Goal::class);
    }

    public function members(){
        return $this->hasMany(TeamMember::class);
    }
}
