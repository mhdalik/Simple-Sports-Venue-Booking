<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Models\VenueBooking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VenueBookingController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ // this can move to a form request if validation become bigger
            'user_id' => 'required|exists:users,id',
            'venue_id' => 'required|exists:venues,id',
            'reservation_date' => 'required|date|date_format:Y-m-d|after_or_equal:today|before_or_equal:' . now()->addMonth(),
            'slot' => ['required', 'string', Rule::in(Venue::firstWhere('id', $request->venue_id)?->working_hours)],
            'team_size' => 'nullable|numeric|between:0,100',
        ], $messages = [
            'starting.date_format' => 'Invalid datetime format', //'The starting date must be in the format Y-m-d H:i:s',
            'starting.after_or_equal' => 'The starting date must be today or later',
            'reservation_date.before_or_equal' => 'Booking allowed for maximum 1 month before',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->getMessageBag(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $is_venue_alredy_booked = VenueBooking::where('venue_id', $request->venue_id)
            ->where('reservation_date', $request->reservation_date)
            ->where('slot', $request->slot)
            ->exists();

        if ($is_venue_alredy_booked) {
            return response()->json([
                'message' => 'The venue has already been booking in the selected date and time',
            ], Response::HTTP_CONFLICT);
        }

        $is_booking_created = DB::transaction(function () use ($validator) { // transcation for database interactions, good using this when run multiple inserts
            return VenueBooking::create($validator->validated());
        });

        if ($is_booking_created) {
            return response()->json([
                'message' => 'Venue booking created successfully',
                'data' => $is_booking_created
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'message' => 'Failed to create venue booking',
        ], Response::HTTP_INTERNAL_SERVER_ERROR); // todo: fix this
    }
}
