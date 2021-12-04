<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Moving;

class MovingController extends Controller
{
    public function store(Request $request)
    {
        $moving = new Moving();

        $moving->department_id = $request->department_id;
        $moving->driver_id = $request->driver_id;
        $moving->date = $request->date;
        $moving->address = $request->address;
        $moving->reference = $request->reference;
        $moving->save();

        return response()->json([
            'message' => 'Successfully created moving!',
            'moving' => $moving
        ], 201);
    }

    public function list()
    {
        $movings = Moving::all();

        return response()->json([
            'movings' => $movings
        ], 201);
    }

    public function show($id)
    {
        $moving = Moving::find($id);

        return response()->json([
            'moving' => $moving
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $moving = Moving::find($id);

        $moving->department_id = $request->department_id;
        $moving->driver_id = $request->driver_id;
        $moving->date = $request->date;
        $moving->address = $request->address;
        $moving->reference = $request->reference;

        $moving->update();

        return response()->json([
            'message' => 'Successfully updated moving!'
        ], 201);
    }

    public function destroy($id)
    {
        $moving = Moving::find($id);

        $moving->delete();

        return response()->json([
            'message' => 'Successfully deleted moving!'
        ], 201);
    }
}
