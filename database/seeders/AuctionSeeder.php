<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuctionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            DB::table('auctions')->insert([
                'seller_id' => 1,
                'winner_id' => 2,
                'title' => Str::random(10),
                'image_url' => 'https://majalah.ottenstatic.com/uploads/2017/07/DSC03919.jpg',
                'description' => Str::random(20),
                'asking_price' => rand(1, 99999),
                'ends_at' => Carbon::now()->subDays(rand(1, 365)),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
