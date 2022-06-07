<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\BankAccount;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\Product;
use App\Models\Subscriber;
use App\Models\Supplier;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class InvoiceController extends BaseController
{
    function index(){
        $data['suppliers'] = Supplier::all();
        $data['subscribers'] = Subscriber::all();
        $data['products'] = Product::all();

        return view('new_invoice', ['data' => $data]);
    }

    function redirect(){
        return redirect('new_invoice');
    }

    function create(Request $request){
        $receive_data = $request->all();

        if($receive_data['products'] == "x") return redirect('new_invoice');

        $invoice_number = Invoice::max('number');
        $invoice_number++;

        $invoice = new Invoice;
        $invoice->number = $invoice_number;
        $invoice->supplier_id = $receive_data['supplier'];
        $invoice->subscriber_id = $receive_data['subscriber'];
        $date = new DateTime(now());
        $invoice->create_date = $date;
        $date->modify('+ 14 days');
        $invoice->due_date = $date;
        $invoice->save();

        $products = json_decode($receive_data['products'], true);

        for ($i = 0; $i < count($products); $i++){
            $invoice_product = new InvoiceProduct;
            $invoice_product->invoice_id = $invoice['id'];
            $invoice_product->product_id = $products[$i]['id'];
            $invoice_product->quantity = $products[$i]['quantity'];
            $invoice_product->save();
        }

        $request->session()->flash('invoice_id', $invoice['id']);

        return redirect('invoice');
    }

    function show(){
        $invoice_id = session('invoice_id');

        $data = Invoice::where('id', $invoice_id)->first();

        $supplier = Supplier::where('id', $data['supplier_id'])->first();
        $subscriber = Subscriber::where('id', $data['subscriber_id'])->first();
        $address_sup = Address::where('id', $supplier['address_id'])->first();
        $address_sub = Address::where('id', $subscriber['address_id'])->first();

        $supplier_data['company'] = $supplier['name'];
        $supplier_data['id_number'] = $supplier['id_number'];
        $supplier_data['tax_number'] = $supplier['tax_number'];
        $supplier_data['street'] = $address_sup['street'];
        $supplier_data['city'] = $address_sup['postal_code'] . " " . $address_sup['city'];
        $supplier_data['country'] = $address_sup['country'];
        $supplier_data['bank_accounts'] = BankAccount::where('supplier_id', $supplier['id'])->get();

        $subscriber_data['company'] = $subscriber['name'];
        $subscriber_data['id_number'] = $subscriber['id_number'];
        $subscriber_data['tax_number'] = $subscriber['tax_number'];
        $subscriber_data['street'] = $address_sub['street'];
        $subscriber_data['city'] = $address_sub['postal_code'] . " " . $address_sub['city'];
        $subscriber_data['country'] = $address_sub['country'];

        $products = InvoiceProduct::where('invoice_id', $invoice_id)->get();

        $invoice_data['id'] = $data['number'];
        $invoice_data['var_symbol'] = str_replace( '-', '', $invoice_data['id']);
        $invoice_data['create_date'] = $data['create_date'];
        $invoice_data['due_date'] = $data['due_date'];

        for ($i = 0; $i < count($products); $i++){
            $products_data[$i] = Product::where('id', $products[$i]['product_id'])->first();
            $products_data[$i]['quantity'] = $products[$i]['quantity'];
        }

        return view('invoice', ['supplier_data' => $supplier_data, 'subscriber_data' => $subscriber_data, 'products_data' => $products_data, 'invoice_data' => $invoice_data]);
    }

    function showAll(){
        $data['invoices']['pagination'] = Invoice::paginate(10);
        $data['invoices']['count'] = Invoice::count();

        return view('invoices');
    }

    function data(){
        $data['suppliers'] = Supplier::all();
        $data['subscribers'] = Subscriber::all();
        $data['products'] = Product::all();
        $data['addresses'] = Address::all();

        return $data;
    }

    function update(){
        echo "update user";
    }

    function delete($id){
        echo "delete user";
    }
}
