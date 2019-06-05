<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Invitation;
use App\User;
use App\Guest;

class InvitationController extends Controller
{
    public function list(Request $request)
    {
        $role = $request->user()->roles[0]->id;
        $invitationsCollection = collect([]);
        if( $role = 1)
        {
            $invitations = Invitation::where('status',true)->get();
        }
        else if ($role = 2)
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
        $guest = new Guest();

        $invitation->user_id = $request->user()->id;
        $invitation->invitation_date = $request->invitation_date;
        $invitation->save();

        $guest->name = $request->name;
        $guest->dni = $request->dni;
        $guest->save();

        $guest->invitations()->attach($invitation->id);

        return response()->json([
            'message' => 'Successfully created invitation!'
        ], 201);
    }

    public function addGuest(Request $request, $id)
    {
        $guest = new Guest();

        $guest->name = $request->name;
        $guest->dni = $request->dni;
        $guest->save();

        $guest->invitations()->attach($id);

        return response()->json([
            'message' => 'Successfully added guest!'
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
