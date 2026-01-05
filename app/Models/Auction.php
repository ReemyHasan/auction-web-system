<?php

namespace App\Models;

use App\Enums\AuctionStatus;
use App\Policies\AuctionPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;

#[UsePolicy(AuctionPolicy::class)]
class Auction extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'starting_price',
        'reserve_price',
        'buy_now_price',
        'start_time',
        'end_time',
        'status',
        'currency',
        'blockchain_auction_id',
    ];

    protected $casts = [
        'status' => AuctionStatus::class,
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(AuctionImage::class);
    }

    public function blockchainTransactions()
    {
        return $this->hasMany(BlockchainTransaction::class);
    }

    public function payments()
    {
        return $this->hasMany(AuctionPayment::class);
    }
}
