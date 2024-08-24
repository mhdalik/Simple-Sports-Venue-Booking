<?php

namespace Database\Seeders;

use App\Models\VenueBooking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VenueBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = [
            [
                'venue_id' => 1,
                'user_id' => 1,
                'booking_date' => '2024-08-23',
                'booking_time' => '10:00',
                'booking_end_time' => '11:00',
            ],
            [
                'venue_id' => 1,
                'user_id' => 2,
                'booking_date' => '2024-08-23',
                'booking_time' => '11:00',
                'booking_end_time' => '12:00',
            ],
        ];
    }
}
