<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resident;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResidentCreated;
use Illuminate\Support\Facades\Log;

define('RESIDENT_ROLE_ID', 3);

class UserController extends Controller
{
    public function createResident(Request $request)
    {
        $auth = $request->user();
        
        if($auth->role_id == 1 || $auth->role_id == 2) {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
            ]);

            $resident = new Resident();
            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role_id = RESIDENT_ROLE_ID;
            $user->edifice_id = $auth->edifice_id;
        
            $user->save();
        
            $resident->user_id = $user->id;
            $resident->department_id = $request->department_id;
            $resident->save();

            Mail::to($user)->send(new ResidentCreated());

            return response()->json([ 'message' => 'Successfully created'], 201);

        } else {
            return response()->json([ 'message' => 'unauthorized role'], 401);
        }
    }
}
