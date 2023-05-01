<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Poly;
use App\Models\Roles;
use App\Models\Appointment;
use App\Http\Requests\storeUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function myProfile()
    {
        $user = Auth::user();
        $userID = $user->userid;
        $polyID = $user->polyid;
        $roleID = $user->level;
        $polyName = Poly::where('poly_id', $polyID)->first();
        $roleName = Roles::where('role_id', $roleID)->first();
        
        return view('layout.myprofile')->with('user', $user)->with('polyName', $polyName)->with('roleName', $roleName);
    }

    public function changePassword()
    {
        $user = Auth::user();
        
        return view('layout.changepassword')->with('user', $user);
    }

    public function updateNewPassword(Request $request, $userID)
    {
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8',
        ]);

        $user = Auth::user();
    
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect('/myprofile/'.$userID.'/changepassword')->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }
    
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('/myprofile/'.$userID.'/changepassword')->with('success', 'Password updated successfully.')->with('user', $user);        
    }

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
        $validator = Validator::make($request->all(), [
            'user_fname' => 'required',
            'user_lname' => 'required',
            'user_gender' => 'required',
            'user_room' => 'required',
            'polyid' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:8',
            'level' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect('createaccount')
                        ->withErrors($validator)
                        ->withInput();
        } else {
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

            $username = $user->username;
            $getUser = User::where('username', $username)->first();
            $userID = $getUser->userid;
        
            return redirect('/user/'.$userID)->with('status', 'New User Account Has Been Added');   
        }     
    }

    public function list()
    {
        $user = Auth::user();
        $useraccount =  User::join('polyclinic','users.polyid','=','polyclinic.poly_id')
                            ->join('roles','users.level','=','roles.role_id')
                            ->select('users.*', 'poly_name', 'role_name')
                            ->get();
                        
        $admin= User::all()->where('level','=','R001')->count();
        $receptionist = User::all()->where('level', 'R002')->count();
        $physician = User::all()->where('level', 'R003')->count();
        $pharmacy = User::all()->where('level', 'R004')->count();
        $finance = User::all()->where('level', 'R005')->count();

        return view('admin.useraccount')->with('useraccount', $useraccount)->with('user',$user)->with('admin', $admin)->with('receptionist', $receptionist)
        ->with('physician', $physician)->with('pharmacy', $pharmacy)->with('finance', $finance);
    }

    public function show($id)
    {
        $user = Auth::user();
        $userlist = User::join('polyclinic','users.polyid','=','polyclinic.poly_id')
                        ->join('roles','users.level','=','roles.role_id')
                        ->select('users.*', 'poly_name', 'role_name')
                        ->where('users.userid','=',$id)
                        ->get();

        return view('admin.showuser')->with('user',$user)->with('userlist',$userlist);
    }

    public function edit(Request $request, $id)
    {
        $user = Auth::user();
        $userlist = User::join('polyclinic','users.polyid','=','polyclinic.poly_id')
                        ->join('roles','users.level','=','roles.role_id')
                        ->select('users.*', 'poly_name', 'role_name')
                        ->where('users.userid','=',$id)
                        ->get();
        $polyclinic = Poly::all();
        $role = Roles::all();

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
        }
        return view('admin.edituser')->with('polyclinic',$polyclinic)->with('role',$role)->with('userlist',$userlist)->with('user',$user);
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
        $useraccount->email = $request->email;
        $useraccount->user_room = $request->user_room;
        $useraccount->polyid = $request->polyid;
        $useraccount->level = $request->level;
        $useraccount->update();

        return redirect('/user/'.$id);
    }

    public function destroy($id) {
        $user = Auth::user();
        $useraccount = User::findOrFail($id);
        $imagename = User::select('user_pp')->where('users.userid','=',$id)->get();       
        $image_path = public_path().'/uploads/users/'.$useraccount->user_pp;
            if($useraccount->user_pp) {
                unlink($image_path);
            }
        $useraccount->delete();
        return redirect('/useraccount')->with('status', 'Account deleted!')->with('user',$user);
    }

    public function getPhysician() {
        $user = Auth::user();
        $physician = User::join('polyclinic','users.polyid','=','polyclinic.poly_id')
                        ->select('users.*', 'poly_name')
                        ->where('level','=','R003')
                        ->orderBy('user_fname','asc')
                        ->get();      

        return view('breceptionist.physician')->with('user',$user)->with('physician', $physician);
    }

    public function showGetPhysician($id) 
    {
        $today = now()->format('Y-m-d');
        $user = Auth::user();
        $physician = User::join('polyclinic','users.polyid','=','polyclinic.poly_id')
                        ->select('users.*', 'poly_name')
                        ->where('level','=','R003')
                        ->where('userid','=',$id)
                        ->get();
        $polyclinic = Poly::all();
        $appointment = Appointment::join('users','users.userid','=','appointments.DOCTOR_ID')
                        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
                        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
                        ->select('appointments.*', 'user_fname', 'user_mname', 'user_lname', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME', 'poly_name', 'poly_id')
                        ->where('userid','=',$id)
                        ->get();

        $todayAppointment = Appointment::all()->where('APP_DATE', $today)->where('userid', $id);
        $inProgress = Appointment::all()->where('APPOINTMENT_STATUS', 'PROGRESS')->where('userid', $id);
        $finish = Appointment::all()->where('APPOINTMENT_STATUS', 'FINISH')->where('userid', $id);
        $new = Appointment::all()->where('APPOINTMENT_STATUS', 'NEW')->where('userid', $id);

        return view('breceptionist.showphysician')->with('user',$user)->with('physician', $physician)->with('polyclinic', $polyclinic)  
        ->with('appointment', $appointment)->with('todayAppointment', $todayAppointment)->with('inProgress', $inProgress)
        ->with('finish', $finish)->with('new', $new)->with('today', $today);
    }
    
}
