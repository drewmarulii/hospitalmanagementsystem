<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Models\OrderMedicine;
use App\Models\MedicalRecord;
use App\Models\Medicine;
use App\Models\Appointment;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function getOrder()
    {        
        $user = Auth::user();
        
        $today = now()->format('Y-m-d');
        $orderMed = DB::table('medicalrecord')
        ->select('RECORD_ID', 'medicalrecord.APPOINTMENT_ID', 'user_fname', 'user_mname', 'user_lname', 'PATIENTID', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME', 'APP_DATE', 'APPOINTMENT_STATUS')
        ->join('appointments','medicalrecord.APPOINTMENT_ID','=','appointments.APPOINTMENT_ID')
        ->join('users','appointments.DOCTOR_ID','=','users.userid')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->orderBy('APP_DATE', 'DESC')
        ->get();

        $newOrder = Appointment::all()->where('APPOINTMENT_STATUS', 'WAIT-MEDICINE');
        $readyOrder = Appointment::all()->where('APPOINTMENT_STATUS', 'FINISH');
        $finishOrder = Appointment::all()->where('APPOINTMENT_STATUS', 'COMPLETED');

        return view('dpharmacy.medrequest')->with('user', $user)->with('orderMed', $orderMed)->with('readyOrder', $readyOrder)->with('newOrder', $newOrder)->with('finishOrder', $finishOrder);
    }

    public function showOrder($recID)
    {        
        $user = Auth::user();
        $orderDetail = DB::table('appointments')
        ->select('appointments.APPOINTMENT_ID', 'APP_DATE', 'APPOINTMENT_STATUS', 'RECORD_ID', 'PATIENTID', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME', 'PAT_PHONENUMBER', 'PAT_ADDRESS', 'PAT_CITY', 'PAT_COUNTRY', 'user_fname', 'user_mname', 'user_lname', 'is_invoice')
        ->join('users','appointments.DOCTOR_ID','=','users.userid')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->join('medicalrecord','appointments.APPOINTMENT_ID','=','medicalrecord.APPOINTMENT_ID')
        ->where('RECORD_ID','=',$recID)
        ->get();

        $orderMed = DB::table('ordermedicine')
        ->select('*')
        ->join('medicine','ordermedicine.MEDICINE','=','medicine.MEDICINE_ID')
        ->where('MEDRECID','=',$recID)
        ->get();

        $orderPrice = DB::table('ordermedicine')
        ->select(DB::raw("SUM(MED_PRICE) as TOTAL_PRICE"))
        ->join('medicine','ordermedicine.MEDICINE','=','medicine.MEDICINE_ID')
        ->where('MEDRECID','=',$recID)
        ->groupBy('MEDRECID')
        ->get();

        $paymentStatus = DB::table('invoices')
        ->select('INVOICE_ID', 'INVOICE_STATUS', 'PATIENT_ID', 'APPOINTMENT_ID')
        ->join('patient','invoices.PATIENTID','=','patient.PATIENT_ID')
        ->join('appointments','patient.PATIENT_ID','=','appointments.PATIENTID')
        ->first();

        return view('dpharmacy.showmedrequest')->with('user', $user)->with('orderMed', $orderMed)->with('orderDetail',$orderDetail)
            ->with('orderPrice', $orderPrice)->with('paymentStatus', $paymentStatus)->with('recID', $recID);
    }

    public function preparingOrder($recID)
    {        
        $user = Auth::user();
        $orderDetail = DB::table('appointments')
        ->select('user_fname', 'user_mname', 'user_lname')
        ->join('users','appointments.DOCTOR_ID','=','users.userid')
        ->join('medicalrecord','appointments.APPOINTMENT_ID','=','medicalrecord.APPOINTMENT_ID')
        ->where('RECORD_ID','=',$recID)
        ->get();

        $orderMed = DB::table('ordermedicine')
        ->select('*')
        ->join('medicine','ordermedicine.MEDICINE','=','medicine.MEDICINE_ID')
        ->where('MEDRECID','=',$recID)
        ->get();
        return view('dpharmacy.prepmedrequest')->with('user', $user)->with('orderMed', $orderMed)->with('orderDetail',$orderDetail);
    }

    public function bookedItem(Request $request, $recID, $orderID)
    {        
        $user = Auth::user();

        $orderMed = OrderMedicine::where('MED_ORDER_ID', $orderID)->first();

        $ordSTATUS=$request->ORD_STATUS;
        
        $orderMed->ORD_STATUS = $ordSTATUS;
        $orderMed->update();

        if($orderMed->ORD_STATUS=="BOOKED") {
            $ordQTY = $orderMed->QUANTITY;
            $medID = $orderMed->MEDICINE;
            $medicine = Medicine::where('MEDICINE_ID', $medID)->first();
                $stock = $medicine->MED_INSTOCK;
                $newStock = $stock-$ordQTY;
            $medicine->MED_INSTOCK = $newStock;
            $medicine->update();
        };

        return redirect('/medOrderID/'.$recID.'/preparing')->with('status', '');
    }

    public function releaseOrder($recID)
    {        
        $user = Auth::user();

        $orderMed = OrderMedicine::all()->where('MEDRECID','=',$recID);
        $orderMed->count();

        if($orderMed->ORD_STATUS = 'BOOKED') {
            foreach($orderMed as $row) {
                $row->ORD_STATUS = 'COMPLETED';
                $row->update();
            }
        };

        return redirect('/medOrderID/'.$recID)->with('status', 'Medicine Released!');
    }

    public function getMedicines()
    {
        $user = Auth::user();
        $medicine = Medicine::all();

        $safeMedicine = Medicine::all()->where('MED_INSTOCK','>',100);
        $warnMedicine = DB::table('medicine')
        ->select('*')
        ->where('MED_INSTOCK','<',100)
        ->where('MED_INSTOCK','>=',1)
        ->get();
        $finishMedicine = Medicine::all()->where('MED_INSTOCK','<','1');

        return view('dpharmacy.medicine')->with('user', $user)->with('medicine', $medicine)->with('safeMedicine', $safeMedicine)
        ->with('warnMedicine', $warnMedicine)->with('finishMedicine', $finishMedicine);
    }

    public function storeMedicine(Request $request)
    {
        $medicine = new Medicine;
        $medicine->MEDICINE_NAME = $request->MEDICINE_NAME;
        $medicine->QTY_PERPACK = $request->QTY_PERPACK;
        $medicine->QTY_UNIT = $request->QTY_UNIT;
        $medicine->MED_PACKTYPE = $request->MED_PACKTYPE;
        $medicine->MED_PRICE = $request->MED_PRICE;
        $medicine->MED_INSTOCK = $request->MED_INSTOCK;
        $medicine->save();

        return redirect('/medInstock')->with('status', 'New Medicine Has Been Added');
    }

    public function deleteMedicine($medID) {
        $medicine = Medicine::findOrFail($medID);
        
        $medicine->is_active = 0;
        $medicine->update();

        return redirect('/medInstock')->with('status', 'Medicine: '. $medicine->MEDICINE_NAME .'  Successfully Inactive!');
    }

    public function setActive($medID) {
        $medicine = Medicine::findOrFail($medID);
        
        $medicine->is_active = 1;
        $medicine->update();

        return redirect('/medInstock')->with('status', 'Medicine: '. $medicine->MEDICINE_NAME .'  Successfully Active!');
    }

    public function updateMedicine(Request $request, $medID)
    {
        $medicine = Medicine::findOrFail($medID);

        $medicine->MEDICINE_NAME = $request->MEDICINE_NAME;
        $medicine->QTY_PERPACK = $request->QTY_PERPACK;
        $medicine->QTY_UNIT = $request->QTY_UNIT;
        $medicine->MED_PACKTYPE = $request->MED_PACKTYPE;
        $medicine->MED_PRICE = $request->MED_PRICE;
        $medicine->MED_INSTOCK = $request->MED_INSTOCK;

        $medicine->update();

        return redirect('/medInstock')->with('status', 'Medicine: '. $medicine->MEDICINE_NAME .' Successfully Updated!');
    }

    public function medicineReady($recID) {
        $medRec = MedicalRecord::findOrFail($recID);
        $appID = $medRec->APPOINTMENT_ID;

        $appointment = Appointment::find($appID);
        
        $appointment->APPOINTMENT_STATUS = "FINISH";
        $appointment->update();

        return redirect('/medOrderID/'.$recID)->with('status', 'Medicine Order Ready');
    }
}
