<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resident;
use App\User;
use App\Edifice;
use App\Department;

class ResidentController extends Controller
{
    public function list(Request $request)
    {
        $user = $request->user();

        $edifice = Edifice::find($user->edifice_id);

        $residents = Resident::whereIn('department_id',$edifice->departments->pluck('id'))->get();

    }
}
