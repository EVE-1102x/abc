<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth'])->group(function (){
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::get('', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::get('category', [App\Http\Controllers\Admin\CategoyController::class, 'index'])->name('category');
    Route::get('add-category', [App\Http\Controllers\Admin\CategoyController::class, 'create']);
    Route::post('add-category', [App\Http\Controllers\Admin\CategoyController::class, 'store']);
    Route::get('edit-category/{category_id}', [App\Http\Controllers\Admin\CategoyController::class, 'edit']);
    Route::put('edit-category/{category_id}', [App\Http\Controllers\Admin\CategoyController::class, 'update']);
    Route::get('delete-category/{category_id}', [App\Http\Controllers\Admin\CategoyController::class, 'delete']);

    Route::get('product', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('product');
    Route::get('add-product', [App\Http\Controllers\Admin\ProductController::class, 'create']);
    Route::post('add-product', [App\Http\Controllers\Admin\ProductController::class, 'store']);
    Route::get('edit-product/{product_id}', [App\Http\Controllers\Admin\ProductController::class, 'edit']);
    Route::put('edit-product/{product_id}', [App\Http\Controllers\Admin\ProductController::class, 'update']);
    Route::get('delete-product/{product_id}', [App\Http\Controllers\Admin\ProductController::class, 'delete']);

    Route::get('employee', [App\Http\Controllers\Admin\EmployeeController::class, 'index'])->name('employee');
    Route::get('add-employee', [App\Http\Controllers\Admin\EmployeeController::class, 'create']);
    Route::post('add-employee', [App\Http\Controllers\Admin\EmployeeController::class, 'store']);
    Route::get('edit-employee/{employee_id}', [App\Http\Controllers\Admin\EmployeeController::class, 'edit']);
    Route::put('edit-employee/{employee_id}', [App\Http\Controllers\Admin\EmployeeController::class, 'update']);
    Route::get('delete-employee/{employee_id}', [App\Http\Controllers\Admin\EmployeeController::class, 'delete']);

    Route::get('customer', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customer');
    Route::get('edit-customer/{customer}', [App\Http\Controllers\Admin\CustomerController::class, 'edit']);

    Route::get('order', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('order');
    Route::get('add-order', [App\Http\Controllers\Admin\OrderController::class, 'create']);
    Route::post('add-order', [App\Http\Controllers\Admin\OrderController::class, 'create_step2']);
    Route::post('add-order-step2', [App\Http\Controllers\Admin\OrderController::class, 'store']);

    Route::get('edit-order/{order_id}', [App\Http\Controllers\Admin\OrderController::class, 'edit']);
    Route::put('edit-order/{order_id}', [App\Http\Controllers\Admin\OrderController::class, 'update']);
    Route::get('delete-order/{order_id}', [App\Http\Controllers\Admin\OrderController::class, 'delete']);
});
