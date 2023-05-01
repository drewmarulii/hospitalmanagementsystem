<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use Auth;
use DB;
use PDF;
use Illuminate\Http\Request;

class ExportPDF extends Controller
{
    public function medicalRecord($id)
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

        $pdf = PDF::loadView('pdf.medicalrecord', [
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
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('MEDREC '.$id.'.pdf');
    }

    public function medicinePrescription($id)
    {
        $medicine =  DB::table('ordermedicine')
        ->join('medicine', 'ordermedicine.MEDICINE', '=', 'medicine.MEDICINE_ID')
        ->select('ordermedicine.*', 'medicine.*')
        ->where('MEDRECID', '=', $id)
        ->get();
        $medical = MedicalRecord::find($id);
        $appID = $medical->APPOINTMENT_ID;
        $appointment = Appointment::find($appID);
        $getPhysician = $appointment->DOCTOR_ID;
        $getPatient = $appointment->PATIENTID;
        $patient = Patient::find($getPatient);

        if ($patient->PAT_GENDER=="Male") {
            $title = "Mr.";
        } else if ($patient->PAT_GENDER=="Female") {
            $title = "Mrs.";
        }  
        

        $pdf = PDF::loadView('pdf.medicineprescription', [
            'logo' => public_path('logo1.png'),
            'medrec' => $medical,
            'medicines' => $medicine,
            'patients' =>$patient,
            'title' => $title
        ]);
        $pdf->setPaper('a5', 'portrait');

        return $pdf->stream('PRESCRIPTION '.$id.'.pdf');
    }

    public function invoiceRecord($id)
    {      
        $invoice = Invoice::find($id);
        $getPatient = $invoice->PATIENTID;
        $patient = Patient::find($getPatient);

        $invoiceItem = DB::table('invoiceitem')
        ->join('item', 'item.ITEM_ID','=','invoiceitem.ITEMID')
        ->where('INVOICEID','=', $id)
        ->get();

        $treatments =  DB::table('treceived')
        ->join('treatmentlist', 'treceived.TREATMENT_ID', '=', 'treatmentlist.TREATMENT_ID')
        ->select('treceived.*', 'treatmentlist.*')
        ->where('INVOICEID', '=', $id)
        ->get();

        $medicines =  DB::table('ordermedicine')
        ->join('medicine', 'ordermedicine.MEDICINE', '=', 'medicine.MEDICINE_ID')
        ->select('ordermedicine.*', 'medicine.*')
        ->where('INVOICEID', '=', $id)
        ->get();

        $getTreatmentPrice = DB::table('treatmentlist')
        ->select('TREATMENT_PRICE')
        ->join('treceived','treatmentlist.TREATMENT_ID','=','treceived.TREATMENT_ID')
        ->where('INVOICEID','=',$id)
        ->sum('TREATMENT_PRICE');
        
        $getMedicinePrice = DB::table('medicine')
        ->select('MED_PRICE')
        ->join('ordermedicine','medicine.MEDICINE_ID','=','ordermedicine.MEDICINE')
        ->where('INVOICEID','=',$id)
        ->where('ORD_STATUS','=','BOOKED')
        ->sum('MED_PRICE');
        
        $getItemPrice = DB::table('item')
        ->select('ITEM_PRICE')
        ->join('invoiceitem','item.ITEM_ID','=','invoiceitem.ITEMID')
        ->where('INVOICEID','=',$id)
        ->sum('ITEM_PRICE');

        $totalPrice = $getTreatmentPrice + $getMedicinePrice + $getItemPrice;

        $pdf = PDF::loadView('pdf.invoice', [
            'logo' => public_path('logo1.png'),
            'invoice' => $invoice,
            'patient' => $patient,
            'invoiceitem' => $invoiceItem,
            'medicine' => $medicines,
            'treatment' => $treatments,
            'totalprice' => $totalPrice
        ]);
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('PRESCRIPTION '.$id.'.pdf');
    }

    public function paymentRecord($id) 
    {
        $payment = Payment::find($id);
        $getINVOICE = $payment->INVOICEID;
        $invoice = Invoice::find($getINVOICE);
        
        $pdf = PDF::loadView('pdf.payment', [
            'logo' => public_path('logo1.png'),
            'receiptID' => $id,
            'payment' => $payment,
            'invoice' => $invoice,
        ]);
        $pdf->setPaper('a7', 'portrait');

        return $pdf->stream('PRESCRIPTION '.$id.'.pdf');
    }

    public function appointmentRecord($id) 
    {
        $appointment = Appointment::find($id);
            $getPatient = $appointment->PATIENTID;
            $getPhysician = $appointment->DOCTOR_ID;
        $patient = Patient::find($getPatient);
        $physician = User::find($getPhysician);

        if ($patient->PAT_GENDER=="Male") {
            $title = "Mr.";
        } else if ($patient->PAT_GENDER=="Female") {
            $title = "Mrs.";
        }  
        
        $pdf = PDF::loadView('pdf.appointment', [
            'logo' => public_path('logo1.png'),
            'appointment' => $appointment,
            'patient' => $patient,
            'physician' => $physician,
            'title' => $title
        ]);
        $pdf->setPaper('a7', 'portrait');

        return $pdf->stream('PRESCRIPTION '.$id.'.pdf');
    }

}
