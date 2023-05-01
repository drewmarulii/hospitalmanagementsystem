<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;

class PatientController extends Controller
{
    public function list()
    {
        $user = Auth::user();
        $patient = Patient::all();
        return view('breceptionist.patient')->with('patient',$patient)->with('user', $user);
    }

    public function create()
    {
        $user = Auth::user();
        return view('breceptionist.addpatient')->with('user', $user);
    }

    public function store(Request $request) 
    {
        $patient = new Patient;
        $patient->PAT_FNAME = $request->PAT_FNAME;
        $patient->PAT_MNAME = $request->PAT_MNAME;
        $patient->PAT_LNAME = $request->PAT_LNAME;
        $patient->PAT_RELIGION = $request->PAT_RELIGION;
        $patient->PAT_CITIZEN_ID = $request->PAT_CITIZEN_ID;
        $patient->PAT_GENDER = $request->PAT_GENDER;
        $patient->PAT_POB = $request->PAT_POB;
        $patient->PAT_DOB = $request->PAT_DOB;
        $patient->PAT_OCCUPATION = $request->PAT_OCCUPATION;
        $patient->PAT_PHONENUMBER = $request->PAT_PHONENUMBER;
        $patient->PAT_EMAIL = $request->PAT_EMAIL;
        $patient->PAT_MARITALSTAT = $request->PAT_MARITALSTAT;
        $patient->PAT_ADDRESS = $request->PAT_ADDRESS;
        $patient->PAT_CITY = $request->PAT_CITY;
        $patient->PAT_PROVINCE = $request->PAT_PROVINCE;
        $patient->PAT_ZIPCODE = $request->PAT_ZIPCODE;
        $patient->PAT_COUNTRY = $request->PAT_COUNTRY;
        $patient->save();

        $citizenID = $request->PAT_CITIZEN_ID;
        $getPatient = Patient::where('PAT_CITIZEN_ID', $citizenID)->first();
        $patientID = $getPatient->PATIENT_ID;

        return redirect('/patient/'.$patientID)->with('status', 'Patient Has Been Added');
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

    public function show($id)
    {
        $user = Auth::user();
        $patient =  Patient::where('PATIENT_ID', $id)->first();
        $patientID = $patient->PATIENT_ID;
        $dateOfBirth = $patient->PAT_DOB;
        $years = Carbon::parse($dateOfBirth)->age;

        $patient =  Patient::where('PATIENT_ID', $id)->first(); 
        $medRECORD = DB::table('medicalrecord')
        ->select('*')
        ->join('appointments','medicalrecord.APPOINTMENT_ID','=','appointments.APPOINTMENT_ID')
        ->join('users','appointments.DOCTOR_ID','=','users.userid')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->where('PATIENTID','=',$id)
        ->get();

        $appointment = DB::table('appointments')
        ->select('*')
        ->join('users','appointments.DOCTOR_ID','=','users.userid')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->where('PATIENTID','=',$id)
        ->get();

        $finish = Appointment::all()->where('APPOINTMENT_STATUS', 'FINISH')->where('PATIENTID', $id);
        $new = Appointment::all()->where('APPOINTMENT_STATUS', 'NEW')->where('PATIENTID', $id);
        $inProgress = Appointment::all()->where('APPOINTMENT_STATUS', 'PROGRESS');

        $invoice = Invoice::all()->where('PATIENTID', $id);
        $unpaid = Invoice::all()->where('PATIENTID', $id)->where('INVOICE_STATUS', 'WAITING-PAYMENT');
        
        return view('breceptionist.showpatient')->with('patient', $patient)->with('years',$years)
            ->with('user', $user)->with('medRECORD', $medRECORD)->with('appointment', $appointment)->with('invoice', $invoice)
            ->with('finish', $finish)
            ->with('inProgress', $inProgress)
            ->with('new', $new)
            ->with('unpaid', $unpaid);
    }

    public function showMedrec($patient, $medrec)
    {
        $user = Auth::user();
        $medRECORD = DB::table('medicalrecord')
        ->select('*')
        ->join('appointments','medicalrecord.APPOINTMENT_ID','=','appointments.APPOINTMENT_ID')
        ->join('users','appointments.DOCTOR_ID','=','users.userid')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->where('PATIENTID','=',$patient)
        ->where('RECORD_ID','=',$medrec)
        ->get();
        $patient =  Patient::where('PATIENT_ID',$patient)->first();
        $dateOfBirth = $patient->PAT_DOB;
        $years = Carbon::parse($dateOfBirth)->age;

        $treatREC = DB::table('treceived')
        ->select('treceived.TRECEIVED_ID', 'treceived.TREATMENT_ID', 'treceived.MEDRECID', 'treceived.TREATMENT_DESC', 'TREATMENT_NAME')
        ->join('medicalrecord','treceived.MEDRECID','=','medicalrecord.RECORD_ID')
        ->join('treatmentlist','treceived.TREATMENT_ID','=','treatmentlist.TREATMENT_ID')
        ->where('MEDRECID','=',$medrec)
        ->get();

        $medicineREC = DB::table('ordermedicine')
        ->select('ordermedicine.MED_ORDER_ID', 'ordermedicine.QUANTITY', 'ordermedicine.INSTRUCTION', 'ordermedicine.MEDICINE', 'MEDICINE_NAME', 'MED_PACKTYPE')
        ->join('medicalrecord','ordermedicine.MEDRECID','=','medicalrecord.RECORD_ID')
        ->join('medicine','ordermedicine.MEDICINE','=','medicine.MEDICINE_ID')
        ->where('MEDRECID','=',$medrec)
        ->get();

        return view('breceptionist.showmedrec')->with('user', $user)->with('medRECORD', $medRECORD)->with('years',$years)
            ->with('treatREC', $treatREC)->with('medicineREC', $medicineREC);
    }

    public function send($id)
    {
        $patient = Patient::where('PATIENT_ID', $id)->first();

        if($this->isOnline())
        {
            $mail_data = [
                'recipient'=>$patient->PAT_EMAIL,
                'fromEmail'=>'bahadventist@gmail.com',
                'fromName'=>'BAH-ADVENTIST',
                'subject'=>'BAH PATIENT ID CARD',
                'patientID'=>$patient->PATIENT_ID,
                'firstName'=>$patient->PAT_FNAME,
                'lastName'=>$patient->PAT_LNAME,
                'middleName'=>$patient->PAT_MNAME,
                'POB'=>$patient->PAT_POB,
                'DOB'=>$patient->PAT_DOB,
                'address'=>$patient->PAT_ADDRESS,
                'city'=>$patient->PAT_CITY,
                'zipCode'=>$patient->PAT_ZIPCODE,
                'province'=>$patient->PAT_PROVINCE,
                'country'=>$patient->PAT_COUNTRY,
            ];

            \Mail::send('email.email-newuser',$mail_data, function($message) use($mail_data){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'],$mail_data['fromName'])
                        ->subject($mail_data['subject']);
            });
        } else {
            return "No Connection!";
        }

        return redirect('/patient/'.$id)->with('patient', $patient);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $patient = Patient::where('PATIENT_ID', $id)->first();

        return view('breceptionist.editpatient')->with('patient', $patient)->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::where('PATIENT_ID', $id)->first();

        $patient->PAT_FNAME = $request->PAT_FNAME;
        $patient->PAT_MNAME = $request->PAT_MNAME;
        $patient->PAT_LNAME = $request->PAT_LNAME;
        $patient->PAT_RELIGION = $request->PAT_RELIGION;
        $patient->PAT_CITIZEN_ID = $request->PAT_CITIZEN_ID;
        $patient->PAT_GENDER = $request->PAT_GENDER;
        $patient->PAT_POB = $request->PAT_POB;
        $patient->PAT_DOB = $request->PAT_DOB;
        $patient->PAT_OCCUPATION = $request->PAT_OCCUPATION;
        $patient->PAT_PHONENUMBER = $request->PAT_PHONENUMBER;
        $patient->PAT_EMAIL = $request->PAT_EMAIL;
        $patient->PAT_MARITALSTAT = $request->PAT_MARITALSTAT;
        $patient->PAT_ADDRESS = $request->PAT_ADDRESS;
        $patient->PAT_PROVINCE = $request->PAT_PROVINCE;
        $patient->PAT_ZIPCODE = $request->PAT_ZIPCODE;
        $patient->PAT_COUNTRY = $request->PAT_COUNTRY;

        $patient->update();
        return redirect('/patient/'.$id);
    }

    public function destroy($id) {
        $patient = Patient::findOrFail($id);

        $patient->delete();
        return redirect('/patient')->with('flash_message', 'Patient deleted!');
      }

}
