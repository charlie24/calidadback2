<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\TicketStatus;
use App\User;

class TicketController extends Controller
{
    public function create(Request $request)
    {
        $ticket = new Ticket();

        $ticket->user_id = $request->user_id;
        $ticket->ticket_status_id = $request->ticket_status_id;
        $ticket->message = $request->message;

        $ticket->save();
    }

    public function changeStatus($id)
    {
        $ticket = Ticket::find($id);

        $ticketStatus = TicketStatus::find($ticket->ticket_status_id);
        $ticketStatus = $request->ticket_status_name;

        $ticketStatus->update();
    }

    public function list()
    {
        $tickets = Ticket::all();
    }
}
