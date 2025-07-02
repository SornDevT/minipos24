<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // Assuming you have a Category model

class CategoryController extends Controller
{
    //

    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        // return $categories;
        return response()->json($categories);
    }

    public function add(Request $request)
    {
        try {
            $category = new Category();
            $category->CategoryName = $request->CategoryName;
            $category->save();

            $success = true;
            $message = "ເພີ່ມຂໍ້ມູນສຳເລັດ!";
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);

    }

    public function edit($id){

        $category = Category::find($id);
        return response()->json($category);

    }

    public function update(Request $request,$id){
        try {

            $category = Category::find($id);
            $category->CategoryName = $request->CategoryName;
            $category->save();

            $success = true;
            $message = "ອັບເດດຂໍ້ມູນສຳເລັດ!";
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function delete($id){
         try {

            $category = Category::find($id);
            $category->delete();

            $success = true;
            $message = "ລຶບຂໍໍ້ມູນສຳເລັດ!";
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
