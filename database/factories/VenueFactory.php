<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'venue_name' => fake()->streetName(),
            'game' => 'badminton',
            'working_hours' => ['6AM-8AM', '9AM-11AM', '12PM-2PM', '3PM-5PM', '6PM-8PM'],
        ];
    }
}
