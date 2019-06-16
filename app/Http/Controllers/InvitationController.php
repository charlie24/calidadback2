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
            foreach ($invitations as $invitation) {
                $i = [
                    'id' => $invitation->id,
                    'name' => $invitation->name,
                    'dni' => $invitation->dni,
                    'email' => $invitation->email,
                    'comment' => $invitation->comment,
                    'invitation_date' => $invitation->invitation_date,
                    'check' => $invitation->check,
                    'regular_visitor' => $invitation->regular_visitor,
                    'event_id' => $invitation->event_id,
                    'resident_id' => $invitation->resident_id,
                    'resident_name' => $invitation->resident->user->name
                ];
    
                $invitationsCollection->push($i);
            }
        }
        else if ($role == 2 || $role == 4)
        {
            $users = User::where('edifice_id', $user->edifice->id)->get();

            $residents = Resident::whereIn('user_id', $users->pluck('id'))->get();

            $invitations = Invitation::whereIn('resident_id',$residents->pluck('id'))->get();

            foreach ($invitations as $invitation) {
                $i = [
                    'id' => $invitation->id,
                    'name' => $invitation->name,
                    'dni' => $invitation->dni,
                    'email' => $invitation->email,
                    'comment' => $invitation->comment,
                    'invitation_date' => $invitation->invitation_date,
                    'check' => $invitation->check,
                    'regular_visitor' => $invitation->regular_visitor,
                    'event_id' => $invitation->event_id,
                    'resident_id' => $invitation->resident_id,
                    'resident_name' => $invitation->resident->user->name
                ];
    
                $invitationsCollection->push($i);
            }
        }

        else if($role == 3)
        {
            $invitations = Invitation::where('resident_id',$user->residents[0]->id)->get();

            foreach ($invitations as $invitation) {
                $i = [
                    'id' => $invitation->id,
                    'name' => $invitation->name,
                    'dni' => $invitation->dni,
                    'email' => $invitation->email,
                    'comment' => $invitation->comment,
                    'invitation_date' => $invitation->invitation_date,
                    'check' => $invitation->check,
                    'regular_visitor' => $invitation->regular_visitor,
                    'event_id' => $invitation->event_id,
                    'resident_id' => $invitation->resident_id
                ];
    
                $invitationsCollection->push($i);
            }
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