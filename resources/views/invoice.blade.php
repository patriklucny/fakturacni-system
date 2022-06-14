@extends('layouts.master')

@section('content')

<div id="wrapper">
    @include('layouts.navbar')
    <div class="container" style="width: 200mm;padding: 0px;">
        <div class="table-responsive border-0" style="width: 200mm;">
            <table class="table">
                <tbody>
                <tr>
                    <td style="min-width: 50%;width: 100mm;border-style: none;"><img src="/img/logo.png" style="width: 270px;margin-top: 30px;">
                    </td>
                    <td style="width: 100mm;border-style: none;">
                        <hr style="width: 100%; height: 7px; background-color: #0beaec; opacity: 0.8;">
                        <span style="font-size: 35px;font-weight: bold;"><span style="color: rgb(0,0,0);">Faktura</span><span>&nbsp;{{$invoice_data['id']}}</span></span>
                        <p>DAŇOVÝ DOKLAD</p></td>
                </tr>
                <tr>
                    <td style="border-style: none;padding-right: 40px;padding-bottom: 20px;">
                        <hr style="width: 50px;height: 5px; background: #0beaec; margin-bottom: 4px; opacity: 0.8">
                        <p style="font-size: 14px;margin-bottom: 10px;">DODAVATEL</p>
                        <p style="margin-bottom: 4px;font-size: 20px;font-weight: bold;">{{ $supplier_data['company'] }}</p>
                        <p style="font-size: 14px;">{{ $supplier_data['street'] }}<br>{{ $supplier_data['city'] }}<br>{{ $supplier_data['country'] }}</p>
                        <p style="font-size: 14px;"><span style="float: left;">IČO</span><span style="float: right;">{{ $supplier_data['id_number'] }}</span>
                        </p><br>
                        <p style="font-size: 14px;"><span style="float: left;">DIČ</span><span style="float: right;">{{ $supplier_data['tax_number'] }}</span>
                        </p></td>
                    <td style="border-style: none;padding-left: 40px;padding-bottom: 20px;">
                        <hr style="width: 50px;height: 5px; background: #0beaec; margin-bottom: 4px; opacity: 0.8">
                        <p style="font-size: 14px;margin-bottom: 10px;">ODBĚRATEL</p>
                        <p style="margin-bottom: 4px;font-size: 20px;font-weight: bold;">{{ $subscriber_data['company'] }}</p>
                        <p style="font-size: 14px;">{{ $subscriber_data['street'] }}<br>{{ $subscriber_data['city'] }}<br>{{ $subscriber_data['country'] }}</p>
                        <p style="font-size: 14px;"><span style="float: left;">IČO</span><span style="float: right;">{{ $subscriber_data['id_number'] }}</span>
                        </p><br>
                        <p style="font-size: 14px;"><span style="float: left;">DIČ</span><span style="float: right;">{{ $subscriber_data['tax_number'] }}</span>
                        </p></td>
                </tr>
                <tr style="margin-bottom: 25px;font-size: 14px;">
                    <td style="border-style: none;padding-right: 40px;">
                        <span style="float: left;">Způsob platby</span>
                        <span style="float: right;">Převodem</span><br><span style="float: left;">Variabilní symbol</span>
                        <span style="float: right;">{{$invoice_data['var_symbol']}}</span><br>
                        <div style="margin-top: 10px;">
                            @if($supplier_data['bank_accounts'] != [])
                                <span style="font-weight: bold">Bankovní spojení</span>
                            @endif
                            @foreach($supplier_data['bank_accounts'] as $baac)
                                <div><span style="float: left;">{{$baac['bank']}}</span><span style="float: right;">{{$baac['number']}}</span><br></div>
                            @endforeach
                        </div>
                    </td>
                    <td style="border-style: none;padding-left: 40px;"><span style="float: left;">Datum vystavení</span><span
                            style="float: right;">{{$invoice_data['create_date']}}</span><br><span
                            style="float: left;">Datum splatnosti</span><span style="float: right;">{{$invoice_data['due_date']}}</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive border-0" style="width: 200mm;font-size: 15px;">
            <table class="table">
                <thead>
                <tr>
                    <th style="width: 10mm;">#</th>
                    <th>Položka</th>
                    <th style="text-align: right;width: 25mm;">Počet kusů</th>
                    <th style="text-align: right;width: 45mm;">Jedn. cena s DPH</th>
                    <th style="text-align: right;width: 35mm;">Cena s DPH</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products_data as $key => $product)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$product['name']}}</td>
                        <td style="text-align: right;">{{$product['quantity']}}</td>
                        <td style="text-align: right;">{{$product['price']}} Kč</td>
                        <td style="text-align: right;"><?php echo $product['quantity']*$product['price'] ?> Kč</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="table-responsive float-end" style="width: 65mm;font-size: 18px;">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="font-weight: bold;border-style: none;">Celkem</td>
                    <td style="width: 40mm;text-align: right;font-weight: bold;border-style: none;">
                        <?php
                            $price = 0;
                            foreach($products_data as $product){
                                $price += $product['quantity']*$product['price'];
                            }
                            echo $price;
                        ?> Kč
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="save_print_div noprint">
            <button class="btn btn-primary" type="button" style="margin-bottom: 30px;" onclick="window.print()">
                <svg class="bi bi-printer" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" style="width: 20px;height: 20px;font-size: 20px;">
                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"></path>
                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"></path>
                </svg>
            </button>
            <button class="btn btn-danger" type="button" style="margin-bottom: 30px;" onclick="deleteInvoice()">
                <svg class="bi bi-trash" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" style="width: 20px;height: 20px;font-size: 20px;">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                </svg>
            </button>
    </div>
</div>

@endsection
