<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\Activitylog\Traits\LogsActivity;
// use Spatie\Activitylog\LogOptions;

class Folder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function files(){
        return $this->hasMany(FolderFile::class);
    }

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()->logFillable();
    // }
}
