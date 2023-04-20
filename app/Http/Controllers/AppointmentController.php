<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Useraccount;
use App\Models\Poly;

class AppointmentController extends Controller
{
    public function index()
    {        
        $user = Auth::user();
        $appcard = DB::table('appointments')
        ->select('appointments.*', 'user_fname', 'user_mname', 'user_lname', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME', 'poly_name', 'poly_id')
        ->join('users','users.userid','=','appointments.DOCTOR_ID')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
        ->get();
        $appointment = Appointment::all();
        $useraccount = DB::table('users')
        ->select('*')
        ->where('level','=','R003')
        ->get();
        $polyclinic = Poly::all();
        return view('breceptionist.appointment')->with('appointment',$appointment)->with('user', $user)
        ->with('appcard', $appcard)->with('useraccount',$useraccount)->with('polyclinic', $polyclinic);
    }
    
    public function create()
    {
        $user = Auth::user();
        $appointment = Appointment::all();
        $polyclinic = Poly::all();
        $useraccount = DB::table('users')
        ->select('*')
        ->where('level','=','R003')
        ->get();
        return view('breceptionist.addappointment')->with('appointment',$appointment)->with('useraccount',$useraccount)->with('user', $user)->with('polyclinic', $polyclinic);
    }

    public function store(Request $request) 
    {
        $appointment = new Appointment;
        $appointment->APPOINTMENT_ID = $request->APPOINTMENT_ID;
        $appointment->APP_DATE = $request->APP_DATE;
        $appointment->APPOINTMENT_STATUS = 'NEW';
        $appointment->DOCTOR_ID = $request->DOCTOR_ID;
        $appointment->PATIENTID = $request->PATIENTID;
        $appointment->save();
        return redirect('/addappointment')->with('status', 'New Appointment Has Been Added');
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::where('APPOINTMENT_ID', $id)->first();

        $appointment->APP_DATE = $request->APP_DATE;
        $appointment->APPOINTMENT_STATUS = 'NEW';
        $appointment->DOCTOR_ID = $request->DOCTOR_ID;
        $appointment->PATIENTID = $request->PATIENTID;
        $appointment->update();

        return redirect('/appointment');
    }

    public function show($id)
    {
        $appcard = DB::table('appointments')
        ->select('appointments.*', 'user_fname', 'user_mname', 'user_lname', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME', 'poly_name')
        ->join('users','users.userid','=','appointments.DOCTOR_ID')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
        ->get();
            

        return view('/appointment')->with('appcard', $appcard);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $appointment = Appointment::where('APPOINTMENT_ID', $id)->first();
        $appcard = DB::table('appointments')
        ->select('appointments.*', 'user_fname', 'user_mname', 'user_lname', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME', 'poly_name')
        ->join('users','users.userid','=','appointments.DOCTOR_ID')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
        ->where('appointments.APPOINTMENT_ID','=',$id)
        ->get();
        $useraccount = DB::table('users')
        ->select('*')
        ->where('level','=','R003')
        ->get();
        return view('breceptionist.editappointment')->with('appointment', $appointment)
            ->with('appcard', $appcard)->with('useraccount', $useraccount)->with('user', $user);
    }

    public function destroy($id) {
        $appointment = Appointment::findOrFail($id);

        $appointment->delete();
        return redirect('/appointment')->with('status', 'Appointment deleted!');
    }

    public function phyIndex()
    {        
        $user = Auth::user();
        $appcard = DB::table('appointments')
        ->select('appointments.*', 'user_fname', 'user_mname', 'user_lname', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME', 'poly_name', 'poly_id')
        ->join('users','users.userid','=','appointments.DOCTOR_ID')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
        ->orderBy('APPOINTMENT_ID', 'DESC')
        ->get();
        $appointment = Appointment::all();
        $useraccount = DB::table('users')
        ->select('*')
        ->where('level','=','R003')
        ->get();
        $polyclinic = Poly::all();
        return view('cphysician.myappointment')->with('appointment',$appointment)->with('user', $user)
        ->with('appcard', $appcard)->with('useraccount',$useraccount)->with('polyclinic', $polyclinic);
    }

    public function phyQueue()
    {        
        $user = Auth::user();

        $appcard = DB::table('appointments')
        ->select('appointments.*', 'user_fname', 'user_mname', 'user_lname', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME', 'poly_name', 'poly_id')
        ->join('users','users.userid','=','appointments.DOCTOR_ID')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
        ->where('users.userid','=',$user->userid)
        ->where('APPOINTMENT_STATUS','=','NEW')
        ->orderBy('APPOINTMENT_ID', 'ASC')
        ->get();

        $appointment = Appointment::all();

        $useraccount = DB::table('users')
        ->select('*')
        ->where('level','=','R003')
        ->get();

        $polyclinic = Poly::all();

        return view('cphysician.myqueue')->with('appointment',$appointment)->with('user', $user)
        ->with('appcard', $appcard)->with('useraccount',$useraccount)->with('polyclinic', $polyclinic);
    }
}
