<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Medicine;
use App\Models\Invoice;
use App\Models\OrderMedicine;
use App\Charts\UserRoleChart;
use Auth;
use DB;

class DashboardController extends Controller
{
    public function adminIndex()
    {
        $user = Auth::user();
        $account = User::all();
        $admin = User::all()->where('level', 'R001');
        $receptionist = User::all()->where('level', 'R002');
        $physician = User::all()->where('level', 'R003');
        $pharmacy = User::all()->where('level', 'R004');
        $finance = User::all()->where('level', 'R005');

        $users = User::select(DB::raw("COUNT(*) as count"), DB::raw("role_name"))
        ->join('roles','users.level','=','roles.role_id')
        ->groupBy(DB::raw("role_name"))
        ->orderBy('userid','ASC')
        ->pluck('count', 'role_name');
        $labels = $users->keys();
        $data = $users->values();

        $doctor = User::select(DB::raw("COUNT(*) as count1"), DB::raw("poly_name"))
        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
        ->where('level','=','R003')
        ->groupBy('poly_name')
        ->pluck('count1', 'poly_name');
        $labels1 = $doctor->keys();
        $data1 = $doctor->values();

        
        return view ('layout.dashboard.admin', compact('labels', 'data'))->with('user', $user)->with('admin', $admin)->with('receptionist', $receptionist)->with('physician', $physician)
        ->with('pharmacy', $pharmacy)->with('finance', $finance)->with('labels1', $labels1)->with('data1', $data1);    
    }

    public function receptionistIndex()
    {
        $user = Auth::user();
        $patient = Patient::all();
        
        //Patient By Gender
        $users = Patient::select(DB::raw("COUNT(*) as count"), DB::raw("PAT_GENDER"))
        ->groupBy(DB::raw("PAT_GENDER"))
        ->orderBy('PATIENT_ID','ASC')
        ->pluck('count', 'PAT_GENDER');
        $labels = $users->keys();
        $data = $users->values();

        //Patient By Gender
        $users = Patient::select(DB::raw("COUNT(*) as count"), DB::raw("PAT_RELIGION"))
        ->groupBy(DB::raw("PAT_RELIGION"))
        ->orderBy('PATIENT_ID','ASC')
        ->pluck('count', 'PAT_RELIGION');
        $labels1 = $users->keys();
        $data1 = $users->values();

        //Patient By Marital
        $users = Patient::select(DB::raw("COUNT(*) as count"), DB::raw("PAT_MARITALSTAT"))
        ->groupBy(DB::raw("PAT_MARITALSTAT"))
        ->orderBy('PATIENT_ID','ASC')
        ->pluck('count', 'PAT_MARITALSTAT');
        $labels2 = $users->keys();
        $data2 = $users->values();

        $today = now()->format('Y-m-d');
        //Today's Appointment
        $appointment = DB::table('appointments')
        ->select('appointments.*', 'user_fname', 'user_mname', 'user_lname', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME', 'poly_name', 'poly_id')
        ->join('users','users.userid','=','appointments.DOCTOR_ID')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
        // ->where('APP_DATE', $today)
        ->get();

        $todayAppointment = Appointment::all()->where('APP_DATE', $today);
        $inProgress = Appointment::all()->where('APPOINTMENT_STATUS', 'PROGRESS');
        $finish = Appointment::all()->where('APPOINTMENT_STATUS', 'FINISH');
        $new = Appointment::all()->where('APPOINTMENT_STATUS', 'NEW');

        return view('layout.dashboard.receptionist', compact('labels', 'data'))->with('user', $user)->with('patient', $patient)
            ->with('labels1', $labels1)->with('data1', $data1)    
            ->with('labels2', $labels2)->with('data2', $data2)
            ->with('appointment', $appointment)
            ->with('todayAppointment', $todayAppointment)
            ->with('inProgress', $inProgress)
            ->with('finish', $finish)
            ->with('new', $new);  
    }

    public function doctorIndex()
    {
        $user = Auth::user();
        $uid = $user->userid;
        $appointment = Appointment::all()->where('DOCTOR_ID', $uid);

        $today = now()->format('Y-m-d');
        $todayAppointment = Appointment::all()->where('APP_DATE', $today)->where('DOCTOR_ID', $uid);
        $inProgress = Appointment::all()->where('APPOINTMENT_STATUS', 'PROGRESS')->where('DOCTOR_ID', $uid);
        $finish = Appointment::all()->where('APPOINTMENT_STATUS', 'FINISH')->where('DOCTOR_ID', $uid);
        $new = Appointment::all()->where('APPOINTMENT_STATUS', 'NEW')->where('DOCTOR_ID', $uid);

        $users = Appointment::select(DB::raw("COUNT(*) as count"), DB::raw("DATE(created_at) as DATE"))
        ->groupBy(DB::raw("DATE(created_at)"))
        ->orderBy('APPOINTMENT_ID','ASC')
        ->pluck('count', 'DATE');
        $labels = $users->keys();
        $data = $users->values();

        return view ('layout.dashboard.physician', compact('labels', 'data'))->with('user', $user)->with('appointment', $appointment)
            ->with('todayAppointment', $todayAppointment)
            ->with('inProgress', $inProgress)
            ->with('finish', $finish)
            ->with('new', $new)
            ->with('today', $today);
    }

    public function pharmacyIndex()
    {
        $user = Auth::user();
        $medicine = Medicine::all();
        $newOrder = Appointment::all()->where('APPOINTMENT_STATUS', 'WAIT-MEDICINE');
        $readyOrder = Appointment::all()->where('APPOINTMENT_STATUS', 'FINISH');
        $releasedOrder = Appointment::all()->where('APPOINTMENT_STATUS', 'DONE');

        $totalMedicine = Medicine::all();
        $warnMedicine = DB::table('medicine')
        ->select('*')
        ->where('MED_INSTOCK','<',100)
        ->where('MED_INSTOCK','>=',1)
        ->get();
        $finishMedicine = Medicine::all()->where('MED_INSTOCK','<','1');
    
        //Medicine by Pack
        $medicinePack = Medicine::select(DB::raw("COUNT(*) as count"), DB::raw("MED_PACKTYPE"))
        ->groupBy(DB::raw("MED_PACKTYPE"))
        ->pluck('count', 'MED_PACKTYPE');
        $labels = $medicinePack->keys();
        $data = $medicinePack->values();
        
        return view ('layout.dashboard.pharmacy', compact('labels', 'data'))->with('user', $user)->with('medicine', $medicine)
            ->with('newOrder', $newOrder)->with('readyOrder', $readyOrder)->with('releasedOrder', $releasedOrder)
            ->with('totalMedicine', $totalMedicine)->with('warnMedicine', $warnMedicine)->with('finishMedicine', $finishMedicine);
    }

    public function financeIndex()
    {
        $user = Auth::user();
        $today = now()->format('Y-m-d');
        $waitInvoice = Appointment::all()->where('is_invoice', 0)->where('APPOINTMENT_STATUS', 'FINISH');
        $invoice = Invoice::all();
        $unpaidInvoice = Invoice::all()->where('INVOICE_STATUS', 'WAITING-PAYMENT');
        $paidInvoice = Invoice::all()->where('INVOICE_STATUS', 'PAID');
        $overdueInvoice = Invoice::all()->where('INVOICE_STATUS', 'WAITING-PAYMENT') ->where('INVOICE_DATE','<',$today);
        
        return view ('layout.dashboard.finance')->with('user', $user)->with('invoice', $invoice)->with('waitInvoice', $waitInvoice)
        ->with('unpaidInvoice', $unpaidInvoice)->with('paidInvoice', $paidInvoice)->with('overdueInvoice', $overdueInvoice);
    }
}
