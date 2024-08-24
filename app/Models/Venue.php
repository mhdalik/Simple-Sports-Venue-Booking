<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $casts = ['working_hours' => 'array'];

    public function venueBookings()
    {
        return $this->hasMany(VenueBooking::class);
    }
}
