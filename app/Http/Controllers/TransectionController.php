<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transection;
use App\Models\Product;
use App\Models\Bill;
use App\Models\BillItem;


class TransectionController extends Controller
{
    //

    public function index(){

        $sort = \Request::get('sort');
        $perpage = \Request::get('perpage');
        $month_type = \Request::get('month_type');
        $dmy = \Request::get('dmy');


        $m = explode('-', $dmy)[1]; // 2025-07-16
        $y = explode('-', $dmy)[0];

        // get transection by month
        if($month_type === 'm') {
            
            $tran = Transection::orderBy('id', $sort)
                ->whereMonth('created_at', $m)
                ->whereYear('created_at', $y)
                ->paginate($perpage)
                ->toArray();

        } elseif($month_type === 'y') {
            
            $tran = Transection::orderBy('id', $sort)
                ->whereYear('created_at', $y)
                ->paginate($perpage)
                ->toArray();

        } 


        return array_reverse($tran);


    }

    public function add(Request $request)
    {
        try {

            // add bill 
            $bill_id = 'B'.date('YmdHis').rand(100,999);
            $bill = new Bill();
            $bill->BillID = $bill_id;
            $bill->CustomerName = $request->customer_name;
            $bill->PhoneNumber = $request->customer_tel;
            $bill->save();


            foreach($request->listorder as $item){

                // gen tran id
                $tran_id = 'TRN'.date('YmdHis').rand(100,999);

                $transection = new Transection();
                $transection->TranID = $tran_id;
                $transection->TranType = 'income';
                $transection->ProductID = $item['id'];
                $transection->Qty = $item['qty'];
                $transection->Price = $item['price'];
                $transection->Detail = $item['name'];
                $transection->save();

                // update product stork
                $product = Product::find($item['id']);
                if($product){
                    $product->Qty = $product->Qty - $item['qty'];
                    $product->save(); 
                }

                // add bill item
                $bill_item = new BillItem();
                $bill_item->BillID = $bill_id;
                $bill_item->ItemName = $item['name'];
                $bill_item->Qty = $item['qty'];
                $bill_item->Price = $item['price'];
                $bill_item->save();


            }
          

            $success = true;
            $message = "ເພີ່ມຂໍ້ມູນ ສຳເລັດ!";
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
            $bill_id = '';
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
            'bill_id' => $bill_id
        ]);
    }
}
