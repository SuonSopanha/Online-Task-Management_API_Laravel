<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Team;
use App\Models\Project;
use App\Models\ProjectMember;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'full_name',
        'photo_url',
        'additional_info',
        'role',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'additional_info' => 'json'
    ];

    public function providers(){
        return $this->hasMany(Provider::class);
    }

    public function teams(){
        return $this->hasMany(Team::class);
    }

    public function team_members(){
        return $this->hasMany(TeamMember::class);
    }

    public function project_members(){
        return $this->hasMany(ProjectMember::class);
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }

    public function milestones(){
        return $this->hasMany(Milestone::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class,'owner_id');
    }

    public function organizations(){
        return $this->hasMany(Organization::class);
    }

    public function organization_members(){
        return $this->hasMany(OrgMember::class);
    }


}
