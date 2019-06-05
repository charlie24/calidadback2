<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Ticket;
use App\TicketStatus;
use App\User;

class TicketController extends Controller
{
    public function create(Request $request)
    {
        $ticket = new Ticket();

        $ticket->user_id = $request->user()->id;
        $ticket->ticket_status_id = $request->ticket_status_id;
        $ticket->message = $request->message;

        $ticket->save();

        return response()->json([
            'message' => 'Successfully created ticket!'
        ], 201);
    }

    public function changeStatus(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        $ticket->ticket_status_id = $request->ticket_status_id;
        $ticket->update();

        return response()->json([
            'message' => 'Successfully updated ticket!'
        ], 201);
    }

    public function list()
    {
        $ticketsCollection = collect([]);
        $tickets = Ticket::all();

        foreach ($tickets as $ticket) {
            $t = [
                'id' => $ticket->id,
                'message' => $ticket->message,
                'user' => $ticket->user,
                'status' => $ticket->ticketStatus
            ];

            $ticketsCollection->push($t);
        }
        
        return response()->json([
            'tickets' => $ticketsCollection
        ], 201);
    }

    public function ticket($id)
    {
        $ticket = Ticket::find($id);
        
        return response()->json([
            'ticket' => $ticket
        ], 201);
    }
}
