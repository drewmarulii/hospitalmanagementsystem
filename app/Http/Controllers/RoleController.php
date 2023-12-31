<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Roles;

class RoleController extends Controller
{
    public function list()
    {
        $user = Auth::user();
        $roles = Roles::all();
        return view('admin.role')->with('roles',$roles)->with('user', $user);
    }
    
    public function create()
    {
        $roles = Roles::all();
        return view('admin.role')->with('roles',$roles);
    }

    public function store(Request $request) 
    {
        $roles = new Roles;
        $roles->role_name = $request->role_name;
        $roles->save();

        return redirect('/role')->with('status', 'New Role Has Been Added');
    }

    public function edit(Request $request, $roleID) 
    {
        $roles = Roles::find($roleID);
        $roles->role_name = $request->role_name;
        $roles->update();

        return redirect('/role')->with('status', 'Role Updated');
    }

}
