<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'deletable', 'permissions'];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'deletable' => 'boolean',
        'permissions' => 'array',
    ];

    /**
     * Get all of the admins for the Role
     *
     */
    public function admins()
    {
        return $this->hasMany(Admin::class);
    }
}
