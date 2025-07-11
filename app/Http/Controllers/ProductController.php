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

            $ImagePath = 'assets/img/';

            // check if the request has a file for ImagePath
            if ($request->hasFile('ImagePath')) {
                $file = $request->file('ImagePath');
                $filename = 'img_'.time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($ImagePath), $filename);
                $NewImagePath = $ImagePath . $filename; // Store the path to the image
            } else {
                $NewImagePath = null; 
            }



            $product = new Product();
            $product->ProductName = $request->ProductName;
            $product->CategoryID = $request->CategoryID;
            $product->ImagePath = $NewImagePath;
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

            $ImagePath = 'assets/img/';
            $product = Product::find($id);

            // return File size and File Type
            // $file = $request->file('ImagePath');

            // // Get file size in bytes
            // $fileSize = $file->getSize(); // e.g. 102400

            // // Get file size in KB or MB (optional)
            // $fileSizeKB = round($fileSize / 1024, 2); // KB
            // $fileSizeMB = round($fileSize / 1024 / 1024, 2); // MB

            // // Get MIME type
            // $mimeType = $file->getMimeType(); // e.g. image/jpeg

            // // Get original extension
            // $extension = $file->getClientOriginalExtension(); // e.g. jpg

            // // Return info as JSON
            // return response()->json([
            //     'size_bytes' => $fileSize,
            //     'size_kb' => $fileSizeKB,
            //     'size_mb' => $fileSizeMB,
            //     'mime_type' => $mimeType,
            //     'extension' => $extension,
            // ]);



            // If the request has a file for ImagePath, delete the old image if it exists
            if ($request->hasFile('ImagePath')) {
                // Check if the old image exists and delete it
                if ($product->ImagePath && file_exists(public_path($product->ImagePath))) {
                    unlink(public_path($product->ImagePath));
                }   
           


                    // check if the request has a file for ImagePath
                    if ($request->hasFile('ImagePath')) {
                        $file = $request->file('ImagePath');
                        $filename = 'img_'.time() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path($ImagePath), $filename);
                        $NewImagePath = $ImagePath . $filename; // Store the path to the image
                    } else {
                        $NewImagePath = null;
                    }

                    $product->ImagePath = $NewImagePath; // Update the ImagePath
             } else {

                if($request->ImagePath == null){
                    
                    // remove the old image if it exists
                    if ($product->ImagePath && file_exists(public_path($product->ImagePath))) {
                            unlink(public_path($product->ImagePath));
                        } 

                    $product->ImagePath = null; // If no image is uploaded, set ImagePath to null
                }

             }

            
            $product->ProductName = $request->ProductName;
            $product->CategoryID = $request->CategoryID;
            $product->Qty = $request->Qty;
            $product->PriceBuy = $request->PriceBuy;
            $product->PriceSell = $request->PriceSell;
            $product->save();

            $success = true;
            $message = "ອັບເດດສິນຄ້າສຳເລັດ!";
        
            }
        catch (\Illuminate\Database\QueryException $ex) {


            $success = false;
            $message = $ex->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function list(){


         
        $sort = \Request::get('sort'); // Default sort order is ascending
        $category_id = \Request::get('category_id'); // Get the selected category ID
        $search = \Request::get('search'); // Get the search term

        $products = Product::join('categories', 'products.CategoryID', '=', 'categories.id')
        ->select('products.*', 'categories.CategoryName');

        // If a specific category is selected, filter products by that category
        if ($category_id && $category_id !== 'all') {
            $products = $products->where('products.CategoryID', $category_id);
        }

        //    dd($products);

        // If a search term is provided, filter products by multiple fields ProductName, CategoryName, and PriceBuy
        if ($search) {
            $products = $products->where(function ($query) use ($search) {
                $query->where('products.ProductName', 'like', '%' . $search . '%')
                      ->orWhere('categories.CategoryName', 'like', '%' . $search . '%')
                      ->orWhere('products.PriceBuy', 'like', '%' . $search . '%');
            });
        }

        $products = $products->orderBy('products.id', 'asc')
        ->get();


        $category = Category::orderBy('id', 'asc')->get();  

        // return   $products;

        return response()->json([
            'products' => $products,
            'categort' => $category,
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
