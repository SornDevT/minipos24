<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\BillItem;

class BillController extends Controller
{
    //

    public function print($id){

        $bill = Bill::where('BillID',$id)->get();
        $bill_item = BillItem::where('BillID',$id)->get();

        return view('bill',compact('bill','bill_item','id'));

    }
}
