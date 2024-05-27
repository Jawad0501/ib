<?php

namespace App\Helpers;

final class QuoteStatus  {
    public const PENDING = 'pending';
    public const APPROVED = 'approved';
    public const PROCESSING = 'processing';
    public const OUTOFDELIVERY = 'out of delivery';
    public const FULFILLED = 'fulfilled';
    public const REJECT = 'reject';
}
