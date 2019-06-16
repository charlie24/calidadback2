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
        $user = $request->user();
        $role = $user->role->id;
        $invitationsCollection = collect([]);
        if( $role == 1)
        {
            $invitations = Invitation::get();
        }
        else if ($role == 2)
        {
            $invitations = Invitation::where('user_id',$request->user()->id)->get();
        }

        else if($role == 3)
        {
            $invitations = Invitation::where('resident_id',$user->residents[0]->id)->get();
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
        $user = $request->user();
        $invitation = new Invitation();

        if($user->role_id == 3)
        {
            $invitation->resident_id = $user->residents[0]->id;

            if($request->event_id != null)
            {
                $invitation->event_id = $request->event_id;
            }
    
            $invitation->name = $request->name;
            $invitation->email = $request->email;
            $invitation->dni = $request->dni;
            $invitation->comment = $request->comment;
            $invitation->invitation_date = $request->invitation_date;
            $invitation->check = $request->check;
            $invitation->regular_visitor = $request->regular_visitor;
    
            $invitation->save();
    
            return response()->json([
                'message' => 'Successfully created invitation!'
            ], 201);
        }
        else
        {
            return response()->json([
                'message' => 'Only one resident can make a invitation'
            ], 401);
        }


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