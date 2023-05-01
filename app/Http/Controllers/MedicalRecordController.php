<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use App\Models\Appointment;
use App\Models\Tlist;
use App\Models\Patient;
use App\Models\Treceived;
use App\Models\Medicine;
use App\Models\OrderMedicine;
use App\Models\User;
use Auth;
use DB;
use PDF;
use Carbon\Carbon;

class MedicalRecordController extends Controller
{
    public function index($id)
    {        
        $user = Auth::user();
        $appointment = Appointment::find($id);
        $tlist = Tlist::all()->sortBy("TREATMENT_NAME");
        $mdclist = Medicine::all()->sortBy("MEDICINE_NAME");

        $appointment->APPOINTMENT_STATUS = 'PROGRESS';
        $appointment->update();
    
        $appcard = DB::table('appointments')
        ->select('appointments.*', 'user_fname', 'user_mname', 'user_lname', 'PAT_FNAME', 'PATIENT_ID', 'PAT_DOB', 'PAT_GENDER', 'PAT_MNAME', 'PAT_LNAME', 'poly_name')
        ->join('users','users.userid','=','appointments.DOCTOR_ID')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->join('polyclinic','users.polyid','=','polyclinic.poly_id')
        ->where('APPOINTMENT_ID','=',$id)
        ->get();

        $patient = DB::table('appointments')
        ->select('PATIENTID')
        ->where('APPOINTMENT_ID','=',$id)
        ->get()->first();

        $getID= $patient->PATIENTID;

        $medRECORD = DB::table('medicalrecord')
        ->select('*')
        ->join('appointments','medicalrecord.APPOINTMENT_ID','=','appointments.APPOINTMENT_ID')
        ->join('users','appointments.DOCTOR_ID','=','users.userid')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->where('PATIENTID','=', $getID)
        ->get();

        return view('cphysician.addmedicalrecord')->with('user', $user)->with('appcard', $appcard)
            ->with('tlist', $tlist)->with('mdclist', $mdclist)->with('medRECORD', $medRECORD);
    }

    public function store(Request $request, $id) 
    {
        $user = Auth::user();

        $appointment = Appointment::find($id);
        $appid= $appointment->APPOINTMENT_ID;
        //Medical Record
        $medicalrecord = new MedicalRecord;
        $medicalrecord->VS_WEIGHT = $request->VS_WEIGHT;
        $medicalrecord->VS_HEIGHT = $request->VS_HEIGHT;
        $medicalrecord->VS_TEMPERATURE = $request->VS_TEMPERATURE;
        $medicalrecord->VS_HEARTRATE = $request->VS_HEARTRATE;
        $medicalrecord->VS_SYSTOLIC = $request->VS_SYSTOLIC;
        $medicalrecord->VS_DIASTOLIC = $request->VS_DIASTOLIC;
        $medicalrecord->VS_RESPIRATION = $request->VS_RESPIRATION;
        $medicalrecord->MEDREC_DIAGNOSIS = $request->MEDREC_DIAGNOSIS;
        $medicalrecord->MEDREC_COMPLAINTS = $request->MEDREC_COMPLAINTS;
        $medicalrecord->APPOINTMENT_ID = $appid;

        $medicalrecord->save();

        $treceivednum = $request->TREATMENT_ID;
        
        $data = $request->except('_token');

        //Foreach TREATMENT RECEIVED
        $treatmentID = $data['TREATMENT_ID'];
        foreach($treatmentID as $key => $input) {
            $newMedical= MedicalRecord::where('APPOINTMENT_ID', $id)->first();
            $treceived = new Treceived;
            $treceived->TREATMENT_ID = $data['TREATMENT_ID'][$key];
            $treceived->MEDRECID = $newMedical['RECORD_ID'];
            $treceived->TREATMENT_DESC = $data['TREATMENT_DESC'][$key];
            $treceived->save();
        }

        //Foreach MEDICINE REQUEST 
        $medicineID = $data['MEDICINE_ID'];
        foreach($medicineID as $key => $input) {
            $newMedical= MedicalRecord::where('APPOINTMENT_ID', $id)->first();
            $orderMedicine = new OrderMedicine;
            $orderMedicine->QUANTITY = $data['QUANTITY'][$key];
            $orderMedicine->INSTRUCTION = $data['INSTRUCTION'][$key];
            $orderMedicine->ORD_STATUS = 'NEW';
            $orderMedicine->MEDRECID = $newMedical['RECORD_ID'];
            $orderMedicine->MEDICINE = $data['MEDICINE_ID'][$key];
            $orderMedicine->MEDRECID = $newMedical['RECORD_ID'];
            $orderMedicine->save();
        }

        //Update Status APPOINTMENT
        $appointment->APPOINTMENT_STATUS = 'WAIT-MEDICINE';
        $appointment->update();
        
        return redirect('/medicalSummary/'.$id)->with('status', 'Medical Record Added!');
    }

    public function summary($id) 
    {
        $user = Auth::user();
        $newMedical = MedicalRecord::where('APPOINTMENT_ID', $id)->first();
        $appointment = Appointment::where('APPOINTMENT_ID', $id)->first();
        $patientID = $appointment->PATIENTID;
        $getPatient = Patient::where('PATIENT_ID', $patientID)->first();

        $medicalID = $newMedical->RECORD_ID;

        return view('cphysician.medicalsummary')->with('status', 'Medical Record Added!')->with('user', $user)->with('newMedical', $newMedical)
            ->with('getPatient', $getPatient);
    }

    public function cancel($id) 
    {
        $user = Auth::user();
        $appointment = Appointment::find($id);
        $appointment->APPOINTMENT_STATUS = 'NEW';
        $appointment->update();
        return redirect('/myQueue')->with('user', $user);
    }

    public function list()
    {
        $user = Auth::user();
        $doctor=$user->userid;
        $medRECORD = DB::table('medicalrecord')
        ->select('*')
        ->join('appointments','medicalrecord.APPOINTMENT_ID','=','appointments.APPOINTMENT_ID')
        ->join('users','appointments.DOCTOR_ID','=','users.userid')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->where('DOCTOR_ID','=',$doctor)
        ->get();

        return view('cphysician.mymedicalrecord')->with('user', $user)->with('medRECORD', $medRECORD);
    }

    public function exportPDF($id)
    {
        $medical = MedicalRecord::find($id);
        $appID = $medical->APPOINTMENT_ID;
        $appointment = Appointment::find($appID);
        $getPhysician = $appointment->DOCTOR_ID;
        $getPatient = $appointment->PATIENTID;
        $patient = Patient::find($getPatient);
        $physician = User::find($getPhysician);
        $treatments =  DB::table('treceived')
                        ->join('treatmentlist', 'treceived.TREATMENT_ID', '=', 'treatmentlist.TREATMENT_ID')
                        ->select('treceived.*', 'treatmentlist.*')
                        ->where('MEDRECID', '=', $id)
                        ->get();
        $medicines =  DB::table('ordermedicine')
                        ->join('medicine', 'ordermedicine.MEDICINE', '=', 'medicine.MEDICINE_ID')
                        ->select('ordermedicine.*', 'medicine.*')
                        ->where('MEDRECID', '=', $id)
                        ->get();

        if ($patient->PAT_GENDER=="Male") {
            $title = "Mr.";
        } else if ($patient->PAT_GENDER=="Female") {
            $title = "Mrs.";
        }  

        $pdf = PDF::loadView('pdf.pdf', [
            'logo' => public_path('logo1.png'),
            'medrec' => $id,
            'date' => $medical->MEDREC_DATE,
            'appointment' => $appointment->APPOINTMENT_ID,
            'status' => $appointment->APPOINTMENT_STATUS,
            'physicianFNAME' => $physician->user_fname,
            'physicianMNAME' => $physician->user_mname,
            'physicianLNAME' => $physician->user_lname,
            'patientID' => $patient->PATIENT_ID,
            'patientFNAME' => $patient->PAT_FNAME,
            'patientMNAME' => $patient->PAT_MNAME,
            'patientLNAME' => $patient->PAT_LNAME,
            'patientTitle' => $title,
            'phoneNumber' => $patient->PAT_PHONENUMBER,
            'patientADDRESS' => $patient->PAT_ADDRESS,
            'patientCITY' => $patient->PAT_CITY,
            'patientCOUNTRY' => $patient->PAT_COUNTRY,
            'complaints' => $medical->MEDREC_COMPLAINTS,
            'diagnosis' => $medical->MEDREC_DIAGNOSIS,
            'weight' => $medical->VS_WEIGHT,
            'height' => $medical->VS_HEIGHT,
            'temperature' => $medical->VS_TEMPERATURE,
            'heartrate' => $medical->VS_TEMPERATURE,
            'systolic' => $medical->VS_SYSTOLIC,
            'diastolic' => $medical->VS_DIASTOLIC,
            'respiration' => $medical->VS_RESPIRATION,
            'treatment' => $treatments,
            'medicine' => $medicines
        ]);

        return $pdf->stream('MEDREC '.$id.'.pdf');
    }

}
