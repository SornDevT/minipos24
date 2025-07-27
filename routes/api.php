<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransectionController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ReportController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

// Category Routes crud 
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/category', [CategoryController::class, 'index']);
    Route::post('/category/add', [CategoryController::class, 'add']);
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('/category/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/delete/{id}', [CategoryController::class, 'delete']);
});

// create product routes
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/list', [ProductController::class, 'list']);
    Route::post('/product/add', [ProductController::class, 'add']);
    Route::get('/product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('/product/update/{id}', [ProductController::class, 'update']);
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete']);
    Route::get('/product/export', [ProductController::class, 'export']);
    Route::post('/product/import', [ProductController::class, 'import']);
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/transection', [TransectionController::class, 'index']);
    Route::post('/transection/add', [TransectionController::class, 'add']);
    Route::get('/bill/print/{id}', [BillController::class, 'print']);
    Route::get('/report', [ReportController::class, 'index']);
});

