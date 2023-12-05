<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                "name" => "John Doe",
                "username" => "john_doe",
                "email" => "john.doe@gmail.com",
                "phone_number" => "5434734786",
                "address" => "",
                "email_verified_at" => now(),
                "password" => bcrypt("123123"),
                "remember_token" => "",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Richard Roe",
                "username" => "richard_roe",
                "email" => "richard.roe@gmail.com",
                "phone_number" => "46588546778546",
                "address" => "",
                "email_verified_at" => now(),
                "password" => bcrypt("123123"),
                "remember_token" => "",
                "created_at" => now(),
                "updated_at" => now(),
            ]
        ]);
    }
}
