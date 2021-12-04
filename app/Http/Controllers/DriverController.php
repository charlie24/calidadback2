<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver;

class DriverController extends Controller
{
    public function store(Request $request)
    {
        $driver = new Driver();

        $driver->document_id = $request->document_id;
        $driver->document_number = $request->document_number;
        $driver->name = $request->name;
        $driver->last_name = $request->last_name;
        $driver->save();

        return response()->json([
            'message' => 'Successfully created driver!',
            'driver' => $driver
        ], 201);
    }

    public function list()
    {
        $drivers = Driver::all();

        return response()->json([
            'drivers' => $drivers
        ], 201);
    }

    public function show($id)
    {
        $driver = Driver::find($id);

        return response()->json([
            'driver' => $driver
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::find($id);

        $driver->document_id = $request->document_id;
        $driver->document_number = $request->document_number;
        $driver->name = $request->name;
        $driver->last_name = $request->last_name;

        $driver->update();

        return response()->json([
            'message' => 'Successfully updated driver!'
        ], 201);
    }

    public function destroy($id)
    {
        $driver = Driver::find($id);

        $driver->delete();

        return response()->json([
            'message' => 'Successfully deleted driver!'
        ], 201);
    }
}
