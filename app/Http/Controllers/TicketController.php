<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Ticket;
use App\TicketStatus;
use App\TicketCategory;
use App\User;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    public function create(Request $request)
    {
        $user = $request->user();
        $ticket = new Ticket();

        if($user->role_id == 3)
        {
            $ticket->resident_id = $user->residents[0]->id;
            $ticket->ticket_status_id = $request->ticket_status_id;
            $ticket->ticket_category_id = $request->ticket_category_id;
            $ticket->message = $request->message;
    
            $ticket->save();
    
            return response()->json([
                'message' => 'Successfully created ticket!'
            ], 201);
        }else
        {
            return response()->json([
                'message' => 'Only one resident can make a ticket'
            ], 401);
        }
    }

    public function update(Request $request, $id)
    {
        $user = $request->user();
        $ticket = Ticket::find($id);

        if($user->role_id == 3)
        {
            $ticket->ticket_status_id = $request->ticket_status_id;
            $ticket->ticket_category_id = $request->ticket_category_id;
            $ticket->message = $request->message;
    
            $ticket->save();
    
            return response()->json([
                'message' => 'Successfully created ticket!'
            ], 201);
        }else
        {
            return response()->json([
                'message' => 'Only one resident can make a ticket'
            ], 401);
        }
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

    public function list(Request $request)
    {
        $ticketsCollection = collect([]);
        $user = $request->user();
        $tickets = Ticket::when($user->role_id == 3, function($query) use($user) {
                        return $query->where('resident_id', $user->resident->id);
                    })
                    ->search($request->search)
                    ->paginate($request->rowsPerPage);

        foreach ($tickets as $ticket) {
            $t = [
                'id' => $ticket->id,
                'message' => $ticket->message,
                'user' => $ticket->user,
                'status' => $ticket->ticketStatus,
                'created_at' => $ticket->created_at->format('Y-m-d H:i:s')
            ];

            $ticketsCollection->push($t);
        }
        
        return response()->json([
            'tickets' => $ticketsCollection,
            'total' => $tickets->total()
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
