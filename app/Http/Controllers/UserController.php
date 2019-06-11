<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resident;
use App\User;

class UserController extends Controller
{
    const RESIDENT_ROLE_ID = 3;

    public function createResident(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        
        $auth = $request->user();
        $resident = new Resident();
        $user = new User();
        
        switch ($auth->role_id) {
            case 1:
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->role_id = RESIDENT_ROLE_ID;
                $user->edifice_id = $request->edifice_id;
            
                $user->save();
            
                $resident->user_id = $user->user_id;
                $resident->department_id = $request->department_id;
                $resident->save();
                break;

            case 2:
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->role_id = RESIDENT_ROLE_ID;
                $user->edifice_id = $auth->edifice_id;
            
                $user->save();
            
                $resident->user_id = $user->user_id;
                $resident->department_id = $request->department_id;
                $resident->save();
                break;

            default:
                return response()->json([ 'message' => 'unauthorized role'], 401);

        }

        

    }
}
