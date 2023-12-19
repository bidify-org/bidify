<?php

namespace App\Listeners;

use App\Events\AuctionUpdateBuyNowPrice;
use App\Models\Auction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AuctionEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AuctionUpdateBuyNowPrice $event): void
    {
        // Get the auction
        $auction = Auction::find($event->auctionId);

        // Update the buy now price
        $auction->buy_now_price = $event->bidAmount * 1.5;

        // Save the auction
        $auction->save();
    }
}
