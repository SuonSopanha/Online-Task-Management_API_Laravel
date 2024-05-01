<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'org_id',
        'role',
        'is_admin',
    ];

    // Define relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define relationship with organization
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }
}

