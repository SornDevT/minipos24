<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category; // Assuming you have a Category model

class ProductController extends Controller
{
    public function index()


    {

        $perpage = \Request::get('perpage'); // Default to 5 items per page if not specified
        $sort = \Request::get('sort'); // Default sort order is ascending
        $category_id = \Request::get('category_id'); // Get the selected category ID
        $search = \Request::get('search'); // Get the search term

        $products = Product::join('categories', 'products.CategoryID', '=', 'categories.id')
        ->select('products.*', 'categories.CategoryName');

        // If a specific category is selected, filter products by that category
        if ($category_id && $category_id !== 'all') {
            $products = $products->where('products.CategoryID', $category_id);
        }

        // If a search term is provided, filter products by multiple fields ProductName, CategoryName, and PriceBuy
        if ($search) {
            $products = $products->where(function ($query) use ($search) {
                $query->where('products.ProductName', 'like', '%' . $search . '%')
                      ->orWhere('categories.CategoryName', 'like', '%' . $search . '%')
                      ->orWhere('products.PriceBuy', 'like', '%' . $search . '%');
            });
        }

        $products = $products->orderBy('products.id', $sort)
        ->paginate($perpage);


        $category = Category::orderBy('id', 'asc')->get();
        
        return response()->json([
            'products' => $products,
            'category' => $category,
        ]);
    }

    public function add(Request $request)
    {
        try {
            $product = new Product();
            $product->ProductName = $request->ProductName;
            $product->CategoryID = $request->CategoryID;
            $product->ImagePath = $request->ImagePath;
            $product->Qty = $request->Qty;
            $product->PriceBuy = $request->PriceBuy;
            $product->PriceSell = $request->PriceSell;
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
            $product->ImagePath = $request->ImagePath;
            $product->Qty = $request->Qty;
            $product->PriceBuy = $request->PriceBuy;
            $product->PriceSell = $request->PriceSell;
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
