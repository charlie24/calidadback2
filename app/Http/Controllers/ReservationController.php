<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\User;
use App\CommonArea;

class ReservationController extends Controller
{
    public function list()
    {
        $reservations = Reservation::all();
    }

    public function reserve(Request $request)
    {
        $reservation = new Reservation();
        $commonArea = CommonArea::find($request->common_area_id);

        $reservation->user_id = $request->user_id;
        $reservation->common_area_id = $request->common_area_id;
        $reservation->reservation_start_date = $request->reservation_start_date;
        $reservation->reservation_end_date = $request->reservation_end_date;

        $commonArea->available = false;

        $reservation->save();
        $commonArea->update();
    }

    public function change_status($id)
    {
        $reservation = Reservation::find($id);

        $reservation->status = false;

        $commonArea = CommonArea::find($reservation->common_area_id);
        $commonArea->available = true;

        $reservation->update();
        $commonArea->update();
    }
}
