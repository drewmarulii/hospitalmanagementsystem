<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Models\OrderMedicine;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function getOrder()
    {        
        $user = Auth::user();
        
        $orderMed = DB::table('medicalrecord')
        ->select('RECORD_ID', 'medicalrecord.APPOINTMENT_ID', 'user_fname', 'user_mname', 'user_lname', 'PATIENTID', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME', 'APP_DATE', 'APPOINTMENT_STATUS')
        ->join('appointments','medicalrecord.APPOINTMENT_ID','=','appointments.APPOINTMENT_ID')
        ->join('users','appointments.DOCTOR_ID','=','users.userid')
        ->join('patient','appointments.PATIENTID','=','patient.PATIENT_ID')
        ->orderBy('APP_DATE', 'DESC')
        ->get();

        return view('dpharmacy.medrequest')->with('user', $user)->with('orderMed', $orderMed);
    }

    public function showOrder($recID)
    {        
        $user = Auth::user();
        $orderDetail = DB::table('appointments')
        ->select('appointments.APPOINTMENT_ID', 'APP_DATE', 'APPOINTMENT_STATUS', 'RECORD_ID', 'PATIENTID', 'PAT_FNAME', 'PAT_MNAME', 'PAT_LNAME', 'PAT_PHONENUMBER', 'PAT_ADDRESS', 'PAT_CITY', 'PAT_COUNTRY', 'user_fname', 'user_mname', 'user_lname')
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

        return view('dpharmacy.showmedrequest')->with('user', $user)->with('orderMed', $orderMed)->with('orderDetail',$orderDetail)
            ->with('orderPrice', $orderPrice);
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

        $orderMed = DB::table('ordermedicine')
        ->select('*')
        ->where('MEDRECID','=','MR-2023-00001')
        ->get();

        if($orderMed->ORD_STATUS = 'BOOKED') {
            $orderMed->ORD_STATUS = 'RELEASE';
            $orderMed->update();

        } else if($orderMed->ORD_STATUS = 'NOT AVAILABLE') {

        } else {

        };

        return redirect('/medOrderID/'.$recID)->with('status', 'Medicine Released!');
    }

    public function getMedicines()
    {
        $user = Auth::user();
        $medicine = Medicine::all();


        return view('dpharmacy.medicine')->with('user', $user)->with('medicine', $medicine);
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
        $medicine->delete();

        return redirect('/medInstock')->with('status', 'Medicine: '. $medicine->MEDICINE_NAME .'  Successfully deleted!');
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
}
