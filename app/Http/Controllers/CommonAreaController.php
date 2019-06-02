<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommonArea;

class CommonAreaController extends Controller
{
    public function create(Request $request)
    {
        $commonArea = new CommonArea();

        $commonArea->name = $request->name();

        $commonArea->save();

        return response()->json([
            'message' => 'Successfully created common area!'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $commonArea = CommonArea::find($id);

        $commonArea->name = $request->name();

        $commonArea->update();

        return response()->json([
            'message' => 'Successfully updated common area!'
        ], 201);
    }

    public function list()
    {
        $commonAreas = CommonArea::all();

        return response()->json([
            'commonAreas' => $commonAreas
        ], 201);
    }
}
