<?php

use App\Http\Controllers\VenueBookingController;
use App\Http\Controllers\VenueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::prefix('v1/')->group(function () {
    Route::post('book-venue', [VenueBookingController::class, 'store']);
    Route::get('list-venues', [VenueController::class, 'index']);
    Route::get('venues-performance', [VenueController::class, 'venuePerformance']);
});
