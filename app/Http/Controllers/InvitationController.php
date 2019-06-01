<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invitation;
use App\User;
use App\Guest;

class InvitationController extends Controller
{
    public function list()
    {
        $invitations = Invitation::all();
    }

    public function create(Request $request)
    {
        $invitation = new Invitation();
        $guest = new Guest();

        $invitation->user_id = $request->user_id;
        $invitation->invitation_date = $request->invitation_date;
        $invitation->save();

        $guest->name = $request->name;
        $guest->dni = $request->dni;
        $guest->save();

        $guest->invitations()->attach($invitation->id);
    }

    public function addGuest(Request $request, $id)
    {
        $guest = new Guest();

        $guest->name = $request->name;
        $guest->dni = $request->dni;
        $guest->save();

        $guest->invitations()->attach($id);

    }
}
