<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'industry',
        'owner_id',
        'email',
    ];

    // Define relationship with owner (assuming it's a User model)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function members(){
        return $this->hasMany(OrgMember::class, 'org_id');
    }

    public function metrics(){
        return $this->hasMany(OrganizationMetric::class, 'organization_id');
    }

    public function goals(){
        return $this->hasMany(Goal::class, 'organization_id');
    }

    public function projects(){
        return $this->hasMany(Project::class, 'organization_id');
    }
}

