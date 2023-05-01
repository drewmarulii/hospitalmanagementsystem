<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Appointment;
use App\Models\Tlist;
use Illuminate\Http\Request;

class TreatmentItemController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $treatment = Tlist::all();

        return view('efinance.treatmentitem')->with('user', $user)->with('treatment', $treatment);
    }

    public function store(Request $request)
    {
        $treatment = new Tlist;
        $treatment->TREATMENT_NAME = $request->TREATMENT_NAME;
        $treatment->TREATMENT_PRICE = $request->TREATMENT_PRICE;
        $treatment->save();

        return redirect('/treatmentitem')->with('status', 'Treatment has been added');
    }

    public function update(Request $request, $treatID)
    {
        $treatment = Tlist::find($treatID);
        $treatment->TREATMENT_NAME = $request->TREATMENT_NAME;
        $treatment->TREATMENT_PRICE = $request->TREATMENT_PRICE;
        $treatment->update();

        return redirect('/treatmentitem')->with('status', 'Treatment has been updated');
    }

    public function setActive($treatID) {
        $treatment = Tlist::findOrFail($treatID);
        
        $treatment->is_active = 1;
        $treatment->update();

        return redirect('/treatmentitem')->with('status', 'Treatment: '. $treatment->TREATMENT_NAME .'  Successfully Active!');
    }

    public function setInactive($treatID) {
        $treatment = Tlist::findOrFail($treatID);
        
        $treatment->is_active = 0;
        $treatment->update();

        return redirect('/treatmentitem')->with('status', 'Treatment: '. $treatment->TREATMENT_NAME .'  Successfully Inactivated!');
    }
}
