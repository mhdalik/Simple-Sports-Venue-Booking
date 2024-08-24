<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VenueBooking>
 */
class VenueBookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'venue_id' => fake()->randomElement(Venue::pluck('id')),
            'user_id' => fake()->randomElement(User::pluck('id')),
            'reservation_date' => fake()->dateTimeInInterval('now', '-1 year'),
            'slot' => function (array $attributes) {
                return fake()->randomElement(Venue::find($attributes['venue_id'])->working_hours); //  Venue::find($attributes['venue_id'])->working_hours;
            },
            'team_size' => fake()->numberBetween(3, 80),
        ];
    }
}
