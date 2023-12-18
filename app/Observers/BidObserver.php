<?php

namespace App\Observers;

use App\Models\Bid;

class BidObserver
{
    /**
     * Handle the Bid "created" event.
     */
    public function created(Bid $bid): void
    {
        $bid->auction->buy_now_price = $bid->amount * 3;
        $bid->auction->top_bid_amount = $bid->amount;
        $bid->auction->save();
    }
}
