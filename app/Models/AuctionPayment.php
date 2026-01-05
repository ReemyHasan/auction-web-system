<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;

class AuctionPayment extends Model
{
    protected $fillable = [
        'auction_id',
        'user_id',
        'payment_method',
        'payment_reference',
        'amount',
        'status',
    ];

    protected $casts = [
        'status' => PaymentStatus::class,
    ];
    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
