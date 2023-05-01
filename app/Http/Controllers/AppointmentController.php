<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Useraccount;
use App\Models\User;
use App\Models\Poly;
use App\Models\Patient;
use Illuminate\Support\Facades\Notification;
use PDF;

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
        $today = now()->format('Y-m-d');
        $appointment = Appointment::all();
        $useraccount = DB::table('users')
        ->select('*')
        ->where('level','=','R003')
        ->get();
        $todayAppointment = Appointment::all()->where('APP_DATE', $today);
        $inProgress = Appointment::all()->where('APPOINTMENT_STATUS', 'PROGRESS');
        $finish = Appointment::all()->where('APPOINTMENT_STATUS', 'FINISH');
        $new = Appointment::all()->where('APPOINTMENT_STATUS', 'NEW');
        $polyclinic = Poly::all();
        return view('breceptionist.appointment')->with('appointment',$appointment)->with('user', $user)
        ->with('appcard', $appcard)->with('useraccount',$useraccount)->with('polyclinic', $polyclinic)
        ->with('appointment', $appointment)
        ->with('todayAppointment', $todayAppointment)
        ->with('inProgress', $inProgress)
        ->with('finish', $finish)
        ->with('new', $new);  ;
    }
    
    public function create()
    {
        $user = Auth::user();
        $appointment = Appointment::all();
        $polyclinic = Poly::where('poly_id', '!=', 'PL-001')->get();
        $useraccount = DB::table('users')
        ->select('*')
        ->where('level','=','R003')
        ->get();
        return view('breceptionist.addappointment')->with('appointment',$appointment)->with('useraccount',$useraccount)->with('user', $user)->with('polyclinic', $polyclinic);
    }

    public function fetchPhysician(Request $request)
    {
        $data['poly_id'] = User::where("poly_id", $request->poly_id)->get(["poly_id", "poly_name"]);
        return response()->json($data);
    }

    public function store(Request $request) 
    {
        $appointment = new Appointment;
        $appointment->APP_DATE = $request->APP_DATE;
        $appointment->APPOINTMENT_STATUS = 'NEW';
        $appointment->DOCTOR_ID = $request->DOCTOR_ID;
        $appointment->PATIENTID = $request->PATIENTID;
        $appointment->save();

        $patID= $appointment->PATIENTID;
        $currentApp= Appointment::where('PATIENTID', $patID)->where('APPOINTMENT_STATUS', 'NEW')->first();
        $appID = $currentApp->APPOINTMENT_ID;

        return redirect('/appointment/'.$appID.'/summary')->with('status', 'New Appointment Has Been Added');
    }

    public function appointmentCreated($appID)
    {
        $user = Auth::user();

        $appointment = Appointment::where('APPOINTMENT_ID', $appID)->first();
        $patientID = $appointment->PATIENTID;
        $patient = Patient::where('PATIENT_ID', $patientID)->first();
        $doctorID = $appointment->DOCTOR_ID;
        $doctor = User::where('userid', $doctorID)->first();
        $polyID = $doctor->polyid;
        $poly = Poly::where('poly_id', $polyID)->first();

        return view('breceptionist.appointmentCreated')->with('user', $user)
        ->with('appointment', $appointment)->with('patient', $patient)->with('doctor', $doctor)->with('poly', $poly);
    }

    public function isOnline($site = "https://sarra.apiu.edu/")
    {
        if(@fopen($site, "r"))
        {
            return true;
        } else {
            return false;
        }
    }

    public function sendEmailToPatient($appID)
    {
        $appointment = Appointment::where('APPOINTMENT_ID', $appID)->first();
        $getPatientID = $appointment->PATIENTID;
        $patient = Patient::where('PATIENT_ID', $getPatientID)->first();
        $getPhysicianID = $appointment->DOCTOR_ID;
        $physician = User::where('userid', $getPhysicianID)->first();
        $getPolyID = $physician->polyid;
        $poly = Poly::where('poly_id', $getPolyID)->first();

            if($this->isOnline())
            {
            $mail_data = [
                'recipient'=>$patient->PAT_EMAIL,
                'fromEmail'=>'bahadventist@gmail.com',
                'fromName'=>'BAH-ADVENTIST',
                'subject'=>'APPOINTMENT CREATED',
                'appointmentID'=>$appointment->APPOINTMENT_ID,
                'appointmentSTATUS'=>$appointment->APOINTMENT_STATUS,
                'appointmentDate'=>$appointment->APP_DATE,
                'patientfName'=>$patient->PAT_FNAME,
                'patientmName'=>$patient->PAT_MNAME,
                'patientlName'=>$patient->PAT_LNAME,
                'physicianfName'=>$physician->user_fname,
                'physicianmName'=>$physician->user_mname,
                'physicianlName'=>$physician->user_lname,
                'clinic'=>$poly->poly_name,
                'room'=>$physician->user_room,
            ];

            \Mail::send('email.email-appoinmentcreated',$mail_data, function($message) use($mail_data){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'],$mail_data['fromName'])
                        ->subject($mail_data['subject']) ;
            });
        } else {
            return "No Connection!";
        }

        return redirect('/appointment/'.$appID.'/summary')->with('patient', $patient)->with('status', 'Have been sent, Ask your patient check their email!');
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
        $uid = $user->userid;
        $appcard = DB::table('appointments')
        ->select('appointments.*', 'user_fname', 'user_mname', 'user_lname', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME', 'poly_name', 'poly_id')
        ->join('users','users.userid','=','appointments.DOCTOR_ID')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
        ->orderBy('APPOINTMENT_ID', 'DESC')
        ->where('DOCTOR_ID','=',$uid)
        ->get();
        $appointment = Appointment::all();
        $useraccount = DB::table('users')
        ->select('*')
        ->where('level','=','R003')
        ->get();

        $today = now()->format('Y-m-d');
        $todayAppointment = Appointment::all()->where('APP_DATE', $today)->where('DOCTOR_ID', $uid);
        $inProgress = Appointment::all()->where('APPOINTMENT_STATUS', 'PROGRESS')->where('DOCTOR_ID', $uid);
        $finish = Appointment::all()->where('APPOINTMENT_STATUS', 'FINISH')->where('DOCTOR_ID', $uid);
        $new = Appointment::all()->where('APPOINTMENT_STATUS', 'NEW')->where('DOCTOR_ID', $uid);

        $polyclinic = Poly::all();
        return view('cphysician.myappointment')->with('appointment',$appointment)->with('user', $user)
        ->with('appcard', $appcard)->with('useraccount',$useraccount)->with('polyclinic', $polyclinic)
        ->with('todayAppointment', $todayAppointment)
        ->with('inProgress', $inProgress)
        ->with('finish', $finish)
        ->with('new', $new)
        ->with('today', $today);
    }

    public function phyQueue()
    {        
        $user = Auth::user();
        $uid = $user->userid;

        $appcard = DB::table('appointments')
        ->select('appointments.*', 'user_fname', 'user_mname', 'user_lname', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME', 'poly_name', 'poly_id')
        ->join('users','users.userid','=','appointments.DOCTOR_ID')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
        ->where('users.userid','=',$user->userid)
        ->where('APPOINTMENT_STATUS','=','NEW')
        ->orderBy('APPOINTMENT_ID', 'ASC')
        ->get();

        $today = now()->format('Y-m-d');
        $appointment = Appointment::all();
        $todayAppointment = Appointment::all()->where('APP_DATE', $today)->where('DOCTOR_ID', $uid);
        $useraccount = DB::table('users')
        ->select('*')
        ->where('level','=','R003')
        ->get();
        $finish = Appointment::all()->where('APP_DATE', $today)->where('APPOINTMENT_STATUS', 'FINISH')->where('DOCTOR_ID', $uid);
        $polyclinic = Poly::all();

        return view('cphysician.myqueue')->with('appointment',$appointment)->with('user', $user)
        ->with('appcard', $appcard)->with('useraccount',$useraccount)->with('polyclinic', $polyclinic)
        ->with('todayAppointment', $todayAppointment)->with('finish', $finish);
    }
     
}
