<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::withCount('venueBookings')->orderByDesc('venue_bookings_count')->get();

        return response()->json([
            'data' => $venues,
            'highlights' => [
                'highest' => $venues->first(),
                'lowest' => $venues->last(),
            ]
        ]);
    }

    public function venuePerformance(Request $request)
    {
        $validator = Validator::make($request->all(), [ // this can move to a form request if validation become bigger
            'date_from' => 'required|date|date_format:Y-m-d|before_or_equal:' . now()->addMonth(),
            'date_to' => 'required|date|date_format:Y-m-d|after_or_equal:date_from|before_or_equal:' . now()->addMonth(),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->getMessageBag(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $venues = DB::table('venues')
            ->select(
                'venues.*',
                DB::raw('COUNT(venue_bookings.id) as venue_bookings_count'),
                DB::raw('DENSE_RANK() OVER (ORDER BY COUNT(venue_bookings.id) DESC) as rank'),
                DB::raw('( CASE WHEN COUNT(venue_bookings.id) > 15 THEN "A"
                                WHEN COUNT(venue_bookings.id) >= 10 THEN "B"
                                WHEN COUNT(venue_bookings.id) >= 5 THEN "C"
                                ELSE "D"
                        END ) as category'),
            )
            ->whereBetween('venue_bookings.reservation_date', [$request->date_from, $request->date_to])
            ->leftJoin('venue_bookings', 'venues.id', '=', 'venue_bookings.venue_id')
            ->groupBy('venues.id')
            ->get()
            ->map(function ($item) { // to cast json string to array, can be remove if needed
                $item->working_hours = json_decode($item->working_hours, true);
                return $item;
            });

        return response()->json(['data' => $venues]);
    }
}
