<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IncidenceStatus;

class IncidenceStatusController extends Controller
{
    public function list()
    {
        $incidenceStatus = IncidenceStatus::all();

        return response()->json([
            'incidenceStatus' => $incidenceStatus
        ], 201);
    }
}
