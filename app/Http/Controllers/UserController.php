<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Poly;
use App\Models\Roles;

class UserController extends Controller
{
    public function create()
    {
        $poly = Poly::all();
        $role = Roles::all();
        return view('admin.adduseraccount')->with([
            'user' => Auth::user(),
        ])->with('poly', $poly)->with('role', $role);
    }

    public function store(Request $request) 
    {        
        $user = new User;
        $user->userid = $request->userid;
        $user->user_fname = $request->user_fname;
        $user->user_mname = $request->user_mname;
        $user->user_lname = $request->user_lname;
        $user->user_gender = $request->user_gender;
        $user->user_room = $request->user_room;
        $user->polyid = $request->polyid;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->level = $request->level;
        $user->email = $request->email;
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().".".$extention;
            $file->move('uploads/users/',$filename);
            $user->user_pp=$filename;
        }
        $user->save();

        return redirect('/adduseraccount')->with([
            'user' => Auth::user(),
        ])->with('status', 'New User Account Has Been Added');
    }

    public function list()
    {
        $user = Auth::user();
        $useraccount = DB::table('users')
        ->select('users.*', 'poly_name', 'role_name')
        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
        ->join('roles','users.level','=','roles.role_id')
        ->get();
        $admin= DB::table('users')->select('userid')->where('level','=','R001')->get();

        return view('admin.useraccount')->with('useraccount', $useraccount)->with('user',$user)->with('admin', $admin);
    }

    public function show($id)
    {
        $user = Auth::user();
        $useraccount = User::findOrFail($id);
        $userlist = DB::table('users')
        ->select('users.*', 'poly_name', 'role_name')
        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
        ->join('roles','users.level','=','roles.role_id')
        ->where('users.userid','=',$id)
        ->get();
        return view('admin.showuser')->with('useraccount', $useraccount)->with('user',$user)->with('userlist',$userlist);
    }

    public function edit(Request $request, $id)
    {
        $user = Auth::user();
        $useraccount = User::findOrFail($id);
        $userlist = DB::table('users')
        ->select('users.*', 'poly_name', 'role_name')
        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
        ->join('roles','users.level','=','roles.role_id')
        ->where('users.userid','=',$id)
        ->get();
        $useraccount = User::all();
        $polyclinic = Poly::all();
        $role = Roles::all();
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
        }
        return view('admin.edituser')->with('useraccount',$useraccount)->with('polyclinic',$polyclinic)
        ->with('role',$role)->with('userlist',$userlist)->with('user',$user);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $useraccount = User::find($id);
        $image_path = public_path().'/uploads/users/'.$useraccount->user_pp;

        if($useraccount->user_pp) {
            if($request->hasfile('image'))
            {
                unlink($image_path);
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().".".$extention;
                $file->move('uploads/users/',$filename);
                $useraccount->user_pp=$filename;
            }
        } else {
            if($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().".".$extention;
                $file->move('uploads/users/',$filename);
                $useraccount->user_pp=$filename;
            }
        }

        $useraccount->user_fname = $request->user_fname;
        $useraccount->user_mname = $request->user_mname;
        $useraccount->user_lname = $request->user_lname;
        $useraccount->user_gender = $request->user_gender;
        $useraccount->user_room = $request->user_room;
        $useraccount->polyid = $request->polyid;
        $useraccount->level = $request->level;

        $useraccount->update();
        return redirect('/user/'.$id);
    }

    public function destroy($id) {
        $user = Auth::user();
        $useraccount = User::findOrFail($id);
        $imagename = DB::table('users')
        ->select('user_pp')
        ->where('userid','=',$id)
        ->get();

        $image_path = public_path().'/uploads/users/'.$useraccount->user_pp;

        if($useraccount->user_pp) {
            unlink($image_path);
        }

        $useraccount->delete();
        return redirect('/useraccount')->with('flash_message', 'Account deleted!')->with('user',$user);
    }

    public function getPhysician() {
        $user = Auth::user();
        $physician = DB::table('users')
        ->select('users.*', 'poly_name')
        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
        ->where('level','=','R003')
        ->orderBy('user_fname','asc')
        ->get();

        return view('breceptionist.physician')->with('user',$user)->with('physician', $physician);
    }

    public function showGetPhysician($id) {
        $user = Auth::user();
        $physician = DB::table('users')
        ->select('users.*', 'poly_name')
        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
        ->where('level','=','R003')
        ->where('userid','=',$id)
        ->get();
        $polyclinic = Poly::all();
        $appcard = DB::table('appointments')
        ->select('appointments.*', 'user_fname', 'user_mname', 'user_lname', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME', 'poly_name', 'poly_id')
        ->join('users','users.userid','=','appointments.DOCTOR_ID')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
        ->where('userid','=',$id)
        ->get();

        return view('breceptionist.showphysician')->with('user',$user)->with('physician', $physician)
            ->with('appcard', $appcard)->with('polyclinic', $polyclinic);
    }
    
}
