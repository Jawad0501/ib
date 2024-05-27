<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteItems extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the quotes that owns the QuoteItems
     */
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    /**
     * Get the product that owns the QuoteItems
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
