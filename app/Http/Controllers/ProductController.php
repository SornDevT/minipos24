<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'asc')->get();
        return response()->json($products);
    }

    public function add(Request $request)
    {
        try {
            $product = new Product();
            $product->ProductName = $request->ProductName;
            $product->CategoryID = $request->CategoryID;
            $product->Price = $request->Price;
            $product->Image = $request->Image;
            $product->Description = $request->Description;
            $product->save();

            $success = true;
            $message = "ເພີ່ມສິນຄ້າສຳເລັດ!";
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            $product->ProductName = $request->ProductName;
            $product->CategoryID = $request->CategoryID;
            $product->Price = $request->Price;
            $product->Image = $request->Image;
            $product->Description = $request->Description;
            $product->save();

            $success = true;
            $message = "ອັບເດດສິນຄ້າສຳເລັດ!";
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function delete($id)
    {
        try {
            $product = Product::find($id);
            $product->delete();

            $success = true;
            $message = "ລຶບສິນຄ້າສຳເລັດ!";
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
