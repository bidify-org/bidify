<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Storage;

class AuctionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        $placeholderImages = [
            "public/images/placeholder-1.png",
            "public/images/placeholder-2.png",
            "public/images/placeholder-3.png",
            "public/images/placeholder-4.png",
            "public/images/placeholder-5.png",
        ];

        for ($i = 0; $i < 50; $i++) {
            $askingPrice = rand(1, 9999999);
            DB::table('auctions')->insert([
                'seller_id' => 1,
                'winner_id' => 2,
                'title' => fake()->sentence,
                'image_url' => $placeholderImages[rand(0, 4)],
                'description' => fake()->paragraph,
                'asking_price' => $askingPrice,
                'buy_now_price' => $askingPrice * 2,
                'ends_at' => Carbon::now()
                    ->subDays(rand(1, 365))
                    ->addYears(rand(1, 3))
                    ->addMonths(rand(1, 12)),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
