<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get all of the quoteItems for the Product
     */
    public function quoteItems()
    {
        return $this->hasMany(QuoteItems::class);
    }
    
    public function quote()
    {
        return $this->hasOne(Quote::class);
    }
}
