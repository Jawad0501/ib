<?php

namespace App\Models;

use App\Helpers\QuoteStage;
use App\Helpers\QuoteStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'recently_viewed_file' => 'array'
    ];

    /**
     * scope status
     */
    public function scopeStatus($query, $status = QuoteStatus::PENDING)
    {
        return $query->where('status', $status);
    }

    /**
     * scope stage
     */
    public function scopeStage($query, $stage = QuoteStage::QUOTE)
    {
        return $query->where('stage', $stage);
    }

    /**
     * Get all of the items for the Quotes
     *
     */
    public function items()
    {
        return $this->hasMany(QuoteItems::class, 'quote_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the user that owns the Quotes
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

}
