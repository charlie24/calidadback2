<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function create(Request $request)
    {
        $role = new Role();

        $role->name = $request->name();

        $role->save();
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        $role->name = $request->name();

        $role->update();
    }

    public function list()
    {
        $roles = Role::all();
    }
}
