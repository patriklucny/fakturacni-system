<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\BankAccount;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\Product;
use App\Models\Subscriber;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ProductController extends BaseController
{
    function index(){
        $data['type'] = "new";
        return view('product', ['data' => $data]);
    }

    function create(Request $request){
        $receive_data = $request->all();

        $product = new Product;
        $product->name = $receive_data['name'];
        $product->price = $receive_data['price'];
        $product->tax = $receive_data['tax'];
        $product->warranty = $receive_data['warranty'];
        $product->save();

        return redirect('products');
    }

    function show(){
        $product_id = $_COOKIE['product_id'];

        $data = Product::where('id', $product_id)->first();
        $data['type'] = 'update';

        return view('product', ['data' => $data]);
    }

    function showAll(){
        $products = Product::all();
        return view('products', ['data' => $products]);
    }

    function update(Request $request){
        $receive_data = $request->all();

        Product::where('id', $receive_data['id'])->update([
            'name'=>$receive_data['name'],
            'tax'=>$receive_data['tax'],
            'price'=>$receive_data['price'],
            'warranty'=>$receive_data['warranty']
        ]);

        return redirect('products');
    }
}
