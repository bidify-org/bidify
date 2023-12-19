<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $auctionIDs = DB::table('auctions')->pluck('id');
        $userIDs = DB::table('users')->pluck('id');
        foreach ($auctionIDs as $auctionID) {
            $bidCount = rand(10, 25);
            $previousBid = rand(1, 9999999);
            $now = now();
            for ($i = 0; $i < $bidCount; $i++) {
                DB::table('bids')->insert([
                    'user_id' => $userIDs->random(),
                    'auction_id' => $auctionID,
                    'amount' => $previousBid + rand(1, 9999999),
                    'created_at' => $now->addHours($i),
                    'updated_at' => $now->addHours($i),
                ]);
            }
        }
    }
}
