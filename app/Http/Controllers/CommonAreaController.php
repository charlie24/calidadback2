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
    }

    public function update(Request $request, $id)
    {
        $commonArea = CommonArea::find($id);

        $commonArea->name = $request->name();

        $commonArea->update();
    }

    public function list()
    {
        $commonAreas = CommonArea::all();
    }
}
