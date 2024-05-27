<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the quote that owns the Payment
     */
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    /**
     * Get the user that owns the Payment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
