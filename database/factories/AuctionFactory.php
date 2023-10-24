<?php
// database/factories/AuctionFactory.php

namespace Database\Factories;

use App\Models\Auction;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuctionFactory extends Factory
{
    protected $model = Auction::class;

    public function definition()
    {
        return [
            'seller_id' => $this->faker->randomNumber(),
            'winner_id' => $this->faker->randomNumber(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
    }
}



