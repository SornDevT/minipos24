<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transection;
use App\Models\Product;

class ReportController extends Controller
{
    //
    public function index(){
        
        $dmy = \Request::get('dmy');
        $month_type = \Request::get('month_type');

        $m = explode('-',$dmy)[1];
        $y = explode('-',$dmy)[0];

        $labels = []; // ຊື່ເສັ້ນກຣາບແນວນອນ
        $income = []; // ລາຍຮັບ
        $expense = []; // ລາຍຈ່າຍ

        $sum_income = 0;
        $sum_expense = 0;

        if($month_type == 'm'){

            // ຊອກຫາວັນທີ່ສຸດທ້າຍຂອງເດືອນ ຈາກ ວັນເດືອນປີ ທີ່ສົ່ງມາ $dmy, 1, 2 ,3
            $last_day = date("t",strtotime($dmy));

            for ($i=1; $i <= $last_day; $i++) { 
                array_push($labels, "ວັນທີ່ ".$i);
            }

            /// ດຶງຂໍ້ມູນ ການເຄື່ອນໄຫວ ລາຍຮັບ ທີ່ເກີດຂື້ນ ປະຈຳວັນ ຕັ້ງແຕ່ວັນທີ່ເລີ່ມຕົ້ນ ຫາ ສຸດທ້າຍຂອງເດືອນ
            for ($i=1; $i <= $last_day; $i++) { 
                $inc = Transection::whereMonth("created_at",$m)
                ->whereYear("created_at",$y)
                ->whereDay("created_at",$i)
                ->where("TranType","income")
                ->sum("Price");
                array_push($income,$inc);
            }

             /// ດຶງຂໍ້ມູນ ການເຄື່ອນໄຫວ ລາຍຈ່າຍ ທີ່ເກີດຂື້ນ ປະຈຳວັນ ຕັ້ງແຕ່ວັນທີ່ເລີ່ມຕົ້ນ ຫາ ສຸດທ້າຍຂອງເດືອນ
             for ($i=1; $i <= $last_day; $i++) { 
                $exp = Transection::whereMonth("created_at",$m)
                ->whereYear("created_at",$y)
                ->whereDay("created_at",$i)
                ->where("TranType","expense")
                ->sum("Price");
                array_push($expense,$exp);
            }

            // sum income & expense
            $sum_income = Transection::whereMonth("created_at",$m)
            ->whereYear("created_at",$y)
            ->where("TranType","income")
            ->sum("Price");

            $sum_expense = Transection::whereMonth("created_at",$m)
            ->whereYear("created_at",$y)
            ->where("TranType","expense")
            ->sum("Price");

       } else if($month_type == 'y'){



           for ($i=1; $i <= 12; $i++) { 
               array_push($labels, "ເດືອນ ".$i);
           }


           for ($i=1; $i <= 12; $i++) { 
               $inc = Transection::whereMonth("created_at",$i)
               ->whereYear("created_at",$y)
               ->where("TranType","income")
               ->sum("Price");
               array_push($income,$inc);
           }

           for ($i=1; $i <= 12; $i++) { 
               $exp = Transection::whereMonth("created_at",$i)
               ->whereYear("created_at",$y)
               ->where("TranType","expense")
               ->sum("Price");
               array_push($expense,$exp);
           }

           // sum income & expense
           $sum_income = Transection::whereYear("created_at",$y)
           ->where("TranType","income")
           ->sum("Price");

           $sum_expense = Transection::whereYear("created_at",$y)
           ->where("TranType","expense")
           ->sum("Price");
        
       }

       $response = [
           "labels" => $labels,
           "income" => $income,
           "expense" => $expense,
           "sum_income" => $sum_income,
           "sum_expense" => $sum_expense,
       ];

       return response()->json($response);
    }
}
