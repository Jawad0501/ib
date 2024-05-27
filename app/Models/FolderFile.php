<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FolderFile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function folder(){
        return $this->belongsTo(File::class);
    }
}
