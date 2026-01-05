<?php

namespace App\Policies;

use App\Enums\AuctionStatus;
use App\Models\Auction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuctionPolicy
{
    public function update(User $user, Auction $auction)
    {
        return $user->id === $auction->user_id
            && $auction->status === AuctionStatus::DRAFT;
    }

    public function delete(User $user, Auction $auction)
    {
        return $user->id === $auction->user_id
            && in_array($auction->status, [
                AuctionStatus::DRAFT,
                AuctionStatus::CANCELLED
            ]);
    }

    public function view(User $user, Auction $auction)
    {
        return true;
    }

    public function activate(User $user, Auction $auction)
    {
        return $user->id === $auction->user_id
            && $auction->status === AuctionStatus::DRAFT;
    }
}
