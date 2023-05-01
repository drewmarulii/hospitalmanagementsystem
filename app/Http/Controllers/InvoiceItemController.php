<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Item;
use Illuminate\Http\Request;

class InvoiceItemController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $invoiceitem = Item::all();

        return view('efinance.invoiceitem')->with('user', $user)->with('invoiceitem', $invoiceitem);
    }

    public function store(Request $request)
    {
        $invoiceitem = new Item;
        $invoiceitem->ITEM_NAME = $request->ITEM_NAME;
        $invoiceitem->ITEM_PRICE = $request->ITEM_PRICE;
        $invoiceitem->save();

        return redirect('/invoiceitem')->with('status', 'Invoice Item has been added');
    }

    public function update(Request $request, $itemID)
    {
        $invoiceitem = Item::find($itemID);
        $invoiceitem->ITEM_NAME = $request->ITEM_NAME;
        $invoiceitem->ITEM_PRICE = $request->ITEM_PRICE;
        $invoiceitem->update();

        return redirect('/invoiceitem')->with('status', 'Invoice Item has been updated');
    }

    public function setActive($treatID) {
        $invoiceitem = Item::findOrFail($treatID);
        
        $invoiceitem->is_active = 1;
        $invoiceitem->update();

        return redirect('/invoiceitem')->with('status', 'Item: '. $invoiceitem->ITEM_NAME .'  Successfully Active!');
    }

    public function setInactive($treatID) {
        $invoiceitem = Item::findOrFail($treatID);
        
        $invoiceitem->is_active = 0;
        $invoiceitem->update();

        return redirect('/invoiceitem')->with('status', 'Item: '. $invoiceitem->ITEM_NAME .'  Successfully Inactivated!');
    }
}
