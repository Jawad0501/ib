<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    /**
     * Get the module that owns the Permission
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
