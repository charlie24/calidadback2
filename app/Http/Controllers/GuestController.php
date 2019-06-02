<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;
use App\Invitation;

class GuestController extends Controller
{
    public function create(Request $request)
    {
        $guest = new Guest();

        $guest->name = $request->name;
        $guest->dni = $request->dni;

        $guest->save();
    }

    public function update(Request $request, $id)
    {
        $guest = Guest::find($id);

        $guest->name = $request->name;
        $guest->dni = $request->dni;

        $guest->update();
    }

    public function list()
    {
        $guests = Guest::all();
    }

    public function listByInvitation($id)
    {
        $invitation = Invitation::find($id);

        $invitations->guests;
    }
}
