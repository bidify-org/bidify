<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuctionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $askingPrice = rand(1, 9999999);
            DB::table('auctions')->insert([
                'seller_id' => 1,
                'winner_id' => 2,
                'title' => fake()->sentence,
                'image_url' => fake()->imageUrl,
                'description' => fake()->paragraph,
                'asking_price' => $askingPrice,
                'buy_now_price' => $askingPrice * 3,
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
