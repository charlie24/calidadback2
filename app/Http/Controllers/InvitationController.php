<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Invitation;
use App\User;

class InvitationController extends Controller
{
    public function list(Request $request)
    {
        $role = $request->user()->roles[0]->id;
        $invitationsCollection = collect([]);
        if( $role == 1)
        {
            $invitations = Invitation::where('status',true)->get();
        }
        else if ($role == 2)
        {
            $invitations = Invitation::where('status',true)->where('user_id',$request->user()->id)->get();
        }
        
        foreach ($invitations as $invitation) {
            $i = [
                'id' => $invitation->id,
                'invitation_date' => $invitation->invitation_date,
                'status' => $invitation->status,
                'guests' =>$invitation->guests,
                'user' => $invitation->user
            ];

            $invitationsCollection->push($i);
        }
        
        return response()->json([
            'invitations' => $invitationsCollection
        ], 201);
    }

    public function create(Request $request)
    {
        $invitation = new Invitation();

        $invitation->user_id = $request->user()->id;
        $invitation->resident_id = $request->resident_id;

        if($request->event_id != null)
        {
            $invitation->event_id = $request->event_id;
        }

        $invitation->name = $request->name;
        $invitation->email = $request->email;
        $invitation->dni = $request->dni;
        $invitation->comment = $request->comment;
        $invitation->invitation_start_date = $request->invitation_start_date;
        $invitation->invitation_end_date = $request->invitation_end_date;
        $invitation->check = $request->check;
        $invitation->regular_visitor = $request->regular_visitor;

        $invitation->save();

        return response()->json([
            'message' => 'Successfully created invitation!'
        ], 201);
    }

    public function invitation($id)
    {
        $invitation = Invitation::find($id);

        return response()->json([
            'invitation' => $invitation
        ], 201);
    }

    public function changeStatus($id)
    {
        $invitation = Invitation::find($id);

        $invitation->status = false;

        $invitation->update();

        return response()->json([
            'message' => 'Successfully updated invitation!'
        ], 201);
    }
}
