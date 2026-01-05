<?php

namespace App\Enums;

enum AuctionStatus: string
{
    case DRAFT = 'draft';
    case ACTIVE = 'active';
    case ENDED = 'ended';
    case CANCELLED = 'cancelled';
}
