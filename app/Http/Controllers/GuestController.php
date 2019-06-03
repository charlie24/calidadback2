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

        return response()->json([
            'message' => 'Successfully created guest!'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $guest = Guest::find($id);

        $guest->name = $request->name;
        $guest->dni = $request->dni;

        $guest->update();

        return response()->json([
            'message' => 'Successfully updated guest!'
        ], 201);
    }

    public function list()
    {
        $guests = Guest::all();

        return response()->json([
            'guests' => $guests
        ], 201);
    }

    public function listByInvitation($id)
    {
        $invitation = Invitation::find($id);

        return response()->json([
            'guests' => $invitations->guests
        ], 201);
    }

    public function guest($id)
    {
        $guest = Guest::find($id);

        return response()->json([
            'guest' => $guest
        ], 201);
    }
}
