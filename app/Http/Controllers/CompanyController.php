<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\BankAccount;
use App\Models\Subscriber;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class CompanyController extends BaseController
{
    function index(){
        $data['type'] = "new";
        $addresses = Address::all();

        return view('company', ['data' => $data, 'addresses' => $addresses]);
    }

    function create(Request $request){ //TODO
        $receive_data = $request->all();

        $company = new Subscriber();
        if($receive_data['company_type'] == "supplier") $company = new Supplier();

        $company->name = $receive_data['name'];
        $company->phone = $receive_data['phone'];
        $company->email = $receive_data['email'];
        $company->id_number = $receive_data['id_number'];
        $company->tax_number = $receive_data['tax_number'];

        if($receive_data['sel_address'] == "new"){
            $address = new Address();
            $address->street = $receive_data['street'];
            $address->postal_code = $receive_data['postal_code'];
            $address->city = $receive_data['city'];
            $address->country = $receive_data['country'];
            $address->save();
            $company->address_id = $address['id'];
        }
        else{
            $company->address_id = $receive_data['sel_address'];
        }

        $company->save();

        for($i = 1; $i <= 3; $i++){
            if($receive_data['bank_name' . $i] != ""){
                $bankAcc = new BankAccount();
                $bankAcc->bank = $receive_data['bank_name' . $i];
                $bankAcc->number = $receive_data['bank_number' . $i];
                $bankAcc->supplier_id = $company['id'];
                $bankAcc->save();
            }
        }

        $company->save();

        return redirect('companies');
    }

    function show(){
        $company_id = $_COOKIE['company_id'];
        $company_type = $_COOKIE['company_type'];

        $data['id'] = "";
        if($company_type == "supplier") {
            $data = Supplier::where('id', $company_id)->first();
            $bank_accounts = BankAccount::where('supplier_id', $company_id)->get();
            for($i = 0; $i < count($bank_accounts); $i++){
                $data['bank_id' . ($i+1)] = $bank_accounts[$i]['id'];
                $data['bank_name' . ($i+1)] = $bank_accounts[$i]['bank'];
                $data['bank_number' . ($i+1)] = $bank_accounts[$i]['number'];
            }
        }
        elseif($company_type == "subscriber") $data = Subscriber::where('id', $company_id)->first();

        $data['comp_type'] = $company_type;
        $data['type'] = 'update';

        $addresses = Address::all();

        return view('company', ['data' => $data, 'addresses' => $addresses]);
    }

    function showAll(){
        $suppliers = Supplier::all();
        $subscribers = Subscriber::all();
        return view('companies', ['suppliers' => $suppliers, 'subscribers' => $subscribers]);
    }

    function update(Request $request){
        $receive_data = $request->all();

        if($receive_data['sel_address'] == "new"){
            $address = new Address();
            $address->street = $receive_data['street'];
            $address->postal_code = $receive_data['postal_code'];
            $address->city = $receive_data['city'];
            $address->country = $receive_data['country'];
            $address->save();
            $receive_data['sel_address'] = $address['id'];
        }

        $company_table = "subscribers";
        if($receive_data['company_type'] == "Dodavatel") $company_table = "suppliers";

        DB::table($company_table)
            ->where('id', $receive_data['id'])
            ->update([
                'name' => $receive_data['name'],
                'address_id' => $receive_data['sel_address'],
                'phone' => $receive_data['phone'],
                'email' => $receive_data['email'],
                'id_number' => $receive_data['id_number'],
                'tax_number' => $receive_data['tax_number'],
            ]);

        for($i = 1; $i <= 3; $i++){
            if($receive_data['bank_name' . $i] != null){
                if($receive_data['bank_id' . $i] != null){
                    DB::table('bank_accounts')->where('id', $receive_data['bank_id' . $i])
                        ->update(['bank' => $receive_data['bank_name' . $i], 'number' => $receive_data['bank_number' . $i]]);
                }
                else{
                    $bankAcc = new BankAccount();
                    $bankAcc->bank = $receive_data['bank_name' . $i];
                    $bankAcc->number = $receive_data['bank_number' . $i];
                    $bankAcc->supplier_id = $receive_data['id'];
                    $bankAcc->save();
                }
            }
        }

        return redirect('companies');
    }
}
