<?php

namespace App\Observers;

use App\Models\Auction;
use Storage;

class AuctionObserver
{
    /**
     * Handle the Auction "deleted" event.
     */
    public function deleted(Auction $auction): void
    {
        Storage::delete($auction->image_url);
    }
}
