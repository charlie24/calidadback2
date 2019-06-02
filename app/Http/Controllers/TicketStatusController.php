<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketStatus;

class TicketStatusController extends Controller
{
    public function create(Request $request)
    {
        $ticketStatus = new TicketStatus();

        $ticketStatus->name = $request->name;

        $ticketStatus->save();
    }

    public function update(Request $request, $id)
    {
        $ticketStatus = TicketStatus::find($id);

        $ticketStatus->name = $request->name;

        $ticketStatus->update();
    }

    public function list()
    {
        $ticketStates = TicketStatus::all();
    }
}
