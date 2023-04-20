<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Models\Patient;
use App\Models\Treceived;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\MedicalRecord;
use App\Models\OrderMedicine;
use App\Models\Appointment;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function getTransaction()
    {        
        $user = Auth::user();

        $transaction = DB::table('patient')
        ->select('PATIENT_ID', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME', 'medicalrecord.APPOINTMENT_ID', 'DOCTOR_ID', 'APPOINTMENT_STATUS', 'APP_DATE', 'user_fname', 'user_mname', 'user_lname', 'medicalrecord.RECORD_ID')
        ->join('appointments','patient.PATIENT_ID','=','appointments.PATIENTID')
        ->join('users','appointments.DOCTOR_ID','=','users.userid')
        ->join('medicalrecord','appointments.APPOINTMENT_ID','=','medicalrecord.APPOINTMENT_ID')
        ->where('APPOINTMENT_STATUS','=','FIN-UNPAID')
        ->get();

        return view('efinance.getTransaction')->with('status', '')->with('user', $user)->with('transaction', $transaction);
    }

    public function createInvoice($patient, $medrec) 
    {
        $user = Auth::user();

        $transaction = DB::table('patient')
            ->select('PATIENT_ID', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME', 'medicalrecord.APPOINTMENT_ID', 'DOCTOR_ID', 'APPOINTMENT_STATUS', 
            'APP_DATE', 'user_fname', 'user_mname', 'user_lname', 'PAT_ADDRESS', 'PAT_PHONENUMBER', 'PAT_CITY', 'PAT_ADDRESS', 'PAT_COUNTRY', 'medicalrecord.RECORD_ID')
            ->join('appointments','patient.PATIENT_ID','=','appointments.PATIENTID')
            ->join('users','appointments.DOCTOR_ID','=','users.userid')
            ->join('medicalrecord','appointments.APPOINTMENT_ID','=','medicalrecord.APPOINTMENT_ID')
            ->where('RECORD_ID','=',$medrec)
            ->get();
        
        $treatement = DB::table('treceived')
            ->select('TRECEIVED_ID', 'treceived.TREATMENT_ID', 'TREATMENT_NAME', 'TREATMENT_PRICE', 'appointments.APPOINTMENT_ID', 'MEDRECID')
            ->join('treatmentlist','treceived.TREATMENT_ID','=','treatmentlist.TREATMENT_ID')
            ->join('medicalrecord','treceived.MEDRECID','=','medicalrecord.RECORD_ID')
            ->join('appointments','medicalrecord.APPOINTMENT_ID','=','appointments.APPOINTMENT_ID')
            ->where('MEDRECID','=',$medrec)
            ->get();
    
        $medicine = DB::table('ordermedicine')
            ->select('MED_ORDER_ID', 'MEDICINE', 'QUANTITY', 'ORD_STATUS', 'MEDICINE_NAME', 'MED_PRICE', 'MED_PACKTYPE', 'MEDRECID', 'APPOINTMENT_ID')
            ->join('medicine','ordermedicine.MEDICINE','=','medicine.MEDICINE_ID')
            ->join('medicalrecord','ordermedicine.MEDRECID','=','medicalrecord.RECORD_ID')
            ->where('MEDRECID','=',$medrec)
            ->get();
    
        $item = DB::table('item')
        ->select('*')
        ->get();
           
        return view('efinance.createInvoice')->with('status', '')->with('user', $user)->with('transaction', $transaction)
            ->with('treatement', $treatement)->with('medicine', $medicine)->with('item', $item);
    }

    public function generateInvoice(Request $request, $patient, $medrec) 
    {
        $user = Auth::user();

        $invoice = new Invoice;
        $invoice->INVOICE_STATUS = 'WAITING-PAYMENT';
        $invoice->INVOICE_AMOUNT = 0;
        $invoice->PATIENTID = $patient;
        $invoice->save();
        
        $data = $request->except('_token');
        $itemID = $data['ITEM_ID'];
        foreach($itemID as $key => $input) {
            $invoiceID = DB::table('invoices')
                ->select('INVOICE_ID')
                ->join('patient','invoices.PATIENTID','=','patient.PATIENT_ID')
                ->join('appointments','patient.PATIENT_ID','=','appointments.PATIENTID')
                ->join('medicalrecord','appointments.APPOINTMENT_ID','=','medicalrecord.APPOINTMENT_ID')
                ->where('RECORD_ID','=',$medrec)
                ->first();
            $getID = $invoiceID->INVOICE_ID;           
            $invItem = new InvoiceItem;
            $invItem->INVOICEID = $getID;
            $invItem->ITEMID = $data['ITEM_ID'][$key];
            $invItem->save();
        }

        $countTreatment = DB::table('treceived')
        ->select('TRECEIVED_ID')
        ->where('MEDRECID','=',$medrec)
        ->count('TRECEIVED_ID');
        for ($i = 1; $i <= $countTreatment; $i++) {
            $invoiceID = DB::table('invoices')
                ->select('INVOICE_ID')
                ->join('patient','invoices.PATIENTID','=','patient.PATIENT_ID')
                ->join('appointments','patient.PATIENT_ID','=','appointments.PATIENTID')
                ->join('medicalrecord','appointments.APPOINTMENT_ID','=','medicalrecord.APPOINTMENT_ID')
                ->where('RECORD_ID','=',$medrec)
                ->first();
            $getID = $invoiceID->INVOICE_ID;
            $hello = Treceived::where(['MEDRECID' => $medrec])->update(['INVOICEID' => $getID]);
        }

        $countMedicine = DB::table('ordermedicine')
        ->select('MED_ORDER_ID')
        ->where('MEDRECID','=',$medrec)
        ->where('ORD_STATUS','=','BOOKED')
        ->count('MED_ORDER_ID');
        for ($i = 1; $i <= $countMedicine; $i++) {
            $invoiceID = DB::table('invoices')
                ->select('INVOICE_ID')
                ->join('patient','invoices.PATIENTID','=','patient.PATIENT_ID')
                ->join('appointments','patient.PATIENT_ID','=','appointments.PATIENTID')
                ->join('medicalrecord','appointments.APPOINTMENT_ID','=','medicalrecord.APPOINTMENT_ID')
                ->where('RECORD_ID','=',$medrec)
                ->first();
            $getID = $invoiceID->INVOICE_ID;
            $hello = OrderMedicine::where(['MEDRECID' => $medrec])->update(['INVOICEID' => $getID]);
        }

        return redirect('/showInvoice/'.$patient.'/'.$medrec.'/'.$getID.'/generate')->with('user', $user);
    }

    public function storeInvoice($patient, $medrec, $invID) {
        $user = Auth::user();

        $getTreatmentPrice = DB::table('treatmentlist')
        ->select('TREATMENT_PRICE')
        ->join('treceived','treatmentlist.TREATMENT_ID','=','treceived.TREATMENT_ID')
        ->where('INVOICEID','=',$invID)
        ->sum('TREATMENT_PRICE');

        $getMedicinePrice = DB::table('medicine')
        ->select('MED_PRICE')
        ->join('ordermedicine','medicine.MEDICINE_ID','=','ordermedicine.MEDICINE')
        ->where('INVOICEID','=',$invID)
        ->sum('MED_PRICE');

        $getItemPrice = DB::table('item')
        ->select('ITEM_PRICE')
        ->join('invoiceitem','item.ITEM_ID','=','invoiceitem.ITEMID')
        ->where('INVOICEID','=',$invID)
        ->sum('ITEM_PRICE');

        $getInvoice = Invoice::find($invID);
        $totalPrice = $getTreatmentPrice+$getMedicinePrice+$getItemPrice;
        $getInvoice->INVOICE_AMOUNT = $totalPrice;
        $getInvoice->update();

        $appointment = DB::table('appointments')
        ->select('appointments.APPOINTMENT_ID')
        ->join('medicalrecord','appointments.APPOINTMENT_ID','=','medicalrecord.APPOINTMENT_ID')
        ->where('RECORD_ID','=',$medrec)
        ->first();
        $id = $appointment->APPOINTMENT_ID;
        $getAppID = Appointment::find($id);
        $getAppID->APPOINTMENT_STATUS = 'WAIT-PAYMENT';
        $getAppID->update();
        
        return redirect('/showInvoice/'.$patient.'/'.$invID.'/show')->with('user', $user);
    }
    
    public function showInvoice($patient, $invID)
    {        
        $user = Auth::user();

        $invoice = Invoice::where('INVOICE_ID', $invID)->first();
        $patientDetail = Patient::all()->where('PATIENT_ID', $patient)->first();
        $treatmentBill = DB::table('treceived')
        ->select('TRECEIVED_ID', 'TREATMENT_NAME', 'TREATMENT_PRICE')
        ->join('treatmentlist','treceived.TREATMENT_ID','=','treatmentlist.TREATMENT_ID')
        ->where('INVOICEID','=',$invID)
        ->get();
        $medicineBill = DB::table('medicine')
        ->select('MEDICINE_NAME', 'MED_PRICE', 'MED_ORDER_ID', 'QUANTITY', 'MED_PACKTYPE')
        ->join('ordermedicine','medicine.MEDICINE_ID','=','ordermedicine.MEDICINE')
        ->where('INVOICEID','=',$invID)
        ->get();
        $itemBill = DB::table('item')
        ->select('ITEM_PRICE', 'ITEM_NAME', 'INVITEM_ID')
        ->join('invoiceitem','item.ITEM_ID','=','invoiceitem.ITEMID')
        ->where('INVOICEID','=',$invID)
        ->get();

        $getTreatmentPrice = DB::table('treatmentlist')
        ->select('TREATMENT_PRICE')
        ->join('treceived','treatmentlist.TREATMENT_ID','=','treceived.TREATMENT_ID')
        ->where('INVOICEID','=',$invID)
        ->sum('TREATMENT_PRICE');
        $getMedicinePrice = DB::table('medicine')
        ->select('MED_PRICE')
        ->join('ordermedicine','medicine.MEDICINE_ID','=','ordermedicine.MEDICINE')
        ->where('INVOICEID','=',$invID)
        ->sum('MED_PRICE');
        $getItemPrice = DB::table('item')
        ->select('ITEM_PRICE')
        ->join('invoiceitem','item.ITEM_ID','=','invoiceitem.ITEMID')
        ->where('INVOICEID','=',$invID)
        ->sum('ITEM_PRICE');
        $totalPrice = $getTreatmentPrice+$getMedicinePrice+$getItemPrice;

        return view('efinance.showInvoice')->with('status', 'Invoice Has Been Added')->with('user', $user)->with('patientDetail', $patientDetail)
            ->with('invoice', $invoice)->with('treatmentBill', $treatmentBill)->with('medicineBill', $medicineBill)->with('itemBill', $itemBill)
            ->with('totalprice', $totalPrice);
    }

    public function manageInvoice()
    {
        $user = Auth::user();
        $invoice = DB::table('invoices')
        ->select('INVOICE_ID', 'PATIENTID', 'INVOICE_DATE', 'INVOICE_STATUS', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME')
        ->join('patient','invoices.PATIENTID','=','patient.PATIENT_ID')
        ->get();

        return view('efinance.manageInvoice')->with('user', $user)->with('invoice', $invoice);
    }

    public function addPayment()
    {
        $user = Auth::user();

        return view('efinance.addPayment')->with('user', $user);
    }

    public function storePayment(Request $request, $patient, $invID)
    {
        $user = Auth::user();

        return redirect('/showInvoice/'.$patient.'/'.$invID.'/show')->with('user', $user)->with('status', 'Payment has been Made');
    }

    
}
