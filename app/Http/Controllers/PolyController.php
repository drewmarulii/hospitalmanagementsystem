<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Poly;

class PolyController extends Controller
{
    public function list()
    {
        $user=Auth::user();
        $polyclinic = Poly::all();
        return view('admin.polyclinic')->with('polyclinic',$polyclinic)->with('user',$user);
    }
    
    public function create()
    {
        $polyclinic = Poly::all();
        return view('admin.polyclinic')->with('polyclinic',$polyclinic);
    }

    public function store(Request $request) 
    {
        $polyclinic = new Poly;
        $polyclinic->poly_id = $request->poly_id;
        $polyclinic->poly_name = $request->poly_name;
        $polyclinic->save();
        return redirect('/polyclinic')->with('status', 'New Role Has Been Added');
    }

    public function edit(Request $request, $polyID) 
    {
        $polyclinic = Poly::find($polyID);
        $polyclinic->poly_name = $request->poly_name;
        $polyclinic->update();

        return redirect('/polyclinic')->with('status', 'Clinic Name Updated');
    }
}
