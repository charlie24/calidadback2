<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExternalStaff;

class ExternalStaffController extends Controller
{
    public function list($id)
    {
        $staff = ExternalStaff::all();

        return response()->json([
            'staff' => $staff
        ], 201);
    }

    public function listByIncidence($id)
    {
        $staff = ExternalStaff::where('incidence_id',$id)->get();

        return response()->json([
            'staff' => $staff
        ], 201);
    }

    public function store(Request $request)
    {
        $staff = new Incidence();

        $staff->incidence_id = $request->incidence_id;
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->description = $request->description;
        $staff->contact = $request->contact;

        $staff->save();

        return response()->json([
            'message' => 'Successfully created staff!',
        ], 201);
    }

    public function show($id)
    {
        $staff = ExternalStaff::find($id);

        return response()->json([
            'staff' => $staff
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $staff = ExternalStaff::find($id);

        $staff->incidence_id = $request->incidence_id;
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->description = $request->description;
        $staff->contact = $request->contact;

        $staff->update();

        return response()->json([
            'message' => 'Successfully updated staff!'
        ], 201);
    }

    public function destroy($id)
    {
        $staff = ExternalStaff::find($id);

        $staff->delete();

        return response()->json([
            'message' => 'Successfully deleted staff!'
        ], 201);
    }
}
