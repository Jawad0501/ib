<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserUploadedFile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'recently_viewed_file' => 'array'
    ];
}
