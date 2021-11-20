<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IncidenceCategory;

class IncidenceCategoryController extends Controller
{
    public function list()
    {
        $incidenceCategories = IncidenceCategory::all();

        return response()->json([
            'incidenceCategories' => $incidenceCategories
        ], 201);
    }
}
