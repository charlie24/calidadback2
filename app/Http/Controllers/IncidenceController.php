<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Incidence;

class IncidenceController extends Controller
{
    public function list($id)
    {
        $incidences = Incidence::all();

        return response()->json([
            'incidences' => $incidences
        ], 201);
    }

    public function store(Request $request)
    {
        $incidence = new Incidence();

        $incidence->incidence_category_id = $request->incidence_category_id;
        $incidence->incidence_status_id = $request->incidence_status_id;
        $incidence->department_id = $request->department_id;
        $incidence->date = $request->date;
        $incidence->title = $request->title;
        $incidence->description = $request->description;
        $incidence->contact = $request->contact;
        //$incidence->calification = $request->calification;

        $incidence->save();

        return response()->json([
            'message' => 'Successfully created incidence!',
            'incidence' => $incidence
        ], 201);
    }

    public function show($id)
    {
        $incidence = Incidence::find($id);

        return response()->json([
            'incidence' => $incidence
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $incidence = Incidence::find($id);

        $incidence->incidence_category_id = $request->incidence_category_id;
        $incidence->incidence_status_id = $request->incidence_status_id;
        $incidence->department_id = $request->department_id;
        $incidence->date = $request->date;
        $incidence->title = $request->title;
        $incidence->description = $request->description;
        $incidence->contact = $request->contact;
        //$incidence->calification = $request->calification;

        $incidence->update();

        return response()->json([
            'message' => 'Successfully updated incidence!'
        ], 201);
    }

    public function destroy($id)
    {
        $incidence = Incidence::find($id);

        $incidence->delete();

        return response()->json([
            'message' => 'Successfully deleted incidence!'
        ], 201);
    }
}
