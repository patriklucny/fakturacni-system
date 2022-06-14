<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoiceController;
//use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProductController;
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

// --- Invoice ---

Route::get('new_invoice', [InvoiceController::class, 'index']);

Route::POST('create_invoice', [InvoiceController::class, 'create']);

Route::get('invoice', [InvoiceController::class, 'show']);

Route::get('invoices', [InvoiceController::class, 'showAll']);

Route::get('data', [InvoiceController::class, 'data']);

Route::get('delete_invoice', [InvoiceController::class, 'delete']);

// --- Company ---

Route::get('new_company', [CompanyController::class, 'index']); // s prázdnými inputy

Route::POST('create_company', [CompanyController::class, 'create']); // post - odeslání nové firmy

Route::get('companies', [CompanyController::class, 'showAll']); // zobrazení info o firmě

Route::get('company', [CompanyController::class, 'show']); // zobrazení info o firmě

Route::POST('update_company', [CompanyController::class, 'update']); // post - odeslání úpravy firmy

// --- Product ---

Route::get('new_product', [ProductController::class, 'index']);

Route::POST('create_product', [ProductController::class, 'create']);

Route::get('products', [ProductController::class, 'showAll']);

Route::get('product', [ProductController::class, 'show']);

Route::POST('update_product', [ProductController::class, 'update']);
