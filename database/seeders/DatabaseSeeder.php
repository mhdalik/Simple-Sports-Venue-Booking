<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Venue;
use App\Models\VenueBooking;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Venue::factory(10)->create();
        VenueBooking::factory(100)->create();
    }
}
