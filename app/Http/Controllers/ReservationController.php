<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Reservation;
use App\User;
use App\CommonArea;

class ReservationController extends Controller
{
    public function list()
    {
        $reservationsCollection = collect([]);
        $reservations = Reservation::all();

        foreach ($reservations as $reservation) {
            $r = [
                'id' => $reservation->id,
                'reservation_start_date' => $reservation->reservation_start_date,
                'reservation_end_date' => $reservation->reservation_end_date,
                'user' => $reservation->user,
                'commonArea' => $reservation->commonArea
            ];

            $reservationsCollection->push($r);
        }
        
        return response()->json([
            'reservations' => $reservationsCollection
        ], 201);
    }

    public function reserve(Request $request)
    {
        $reservation = new Reservation();
        $commonArea = CommonArea::find($request->common_area_id);

        $reservation->user_id = $request->user()->id;
        $reservation->common_area_id = $request->common_area_id;
        $reservation->reservation_start_date = $request->reservation_start_date;
        $reservation->reservation_end_date = $request->reservation_end_date;

        $commonArea->available = false;

        $reservation->save();
        $commonArea->update();

        return response()->json([
            'message' => 'Successfully created reservation!'
        ], 201);
    }

    public function change_status($id)
    {
        $reservation = Reservation::find($id);

        $reservation->status = false;

        $commonArea = CommonArea::find($reservation->common_area_id);
        $commonArea->available = true;

        $reservation->update();
        $commonArea->update();

        return response()->json([
            'message' => 'Successfully updated reservation!'
        ], 201);
    }

    public function reservation($id)
    {
        $reservation = Reservation::find($id);

        return response()->json([
            'reservation' => $reservation
        ], 201);
    }
}
