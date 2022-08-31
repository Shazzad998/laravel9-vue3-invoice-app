<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/invoices', InvoiceController::class);
Route::get('/search-invoices', [InvoiceController::class, 'search_invoice']);
Route::resource('/customers', CustomerController::class);
