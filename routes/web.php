<?php

use App\Http\Controllers\InvoiceController;
//use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('new_invoice', [InvoiceController::class, 'index']);

Route::get('create_invoice', [InvoiceController::class, 'redirect']);

Route::POST('create_invoice', [InvoiceController::class, 'create']);

Route::get('invoice', [InvoiceController::class, 'show']);

Route::get('invoices', [InvoiceController::class, 'showAll']);

Route::get('data', [InvoiceController::class, 'data']);

//Route::get('new_company', [CompanyController::class, 'show']);

//Route::get('update_company', [CompanyController::class, 'show']);

//Route::get('new_product', [ProductController::class, 'show']);

//Route::get('update_product', [ProductController::class, 'show']);
