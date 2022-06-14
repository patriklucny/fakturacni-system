@extends('layouts.master')

@section('content')

    <div id="wrapper">
        @include('layouts.navbar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content" style="padding-top: 25px;padding-right: 80px;padding-left: 80px;">
                <div class="container">
                    <div class="row">
                        <div class="col" style="margin-bottom: 25px;"><h1>Firma</h1></div>
                    </div>
                </div>
                <form action="@if($data['type'] == "update") update_company @else create_company @endif" method="POST">
                    @csrf
                    <div class="container">
                        <div class="row" style="margin-bottom: 25px;">
                            <div class="col-xl-3 col-lg-4">
                                <label class="form-label">Název</label>
                                <input class="form-control" type="text" style="margin-bottom: 25px;" name="name"
                                       value="@if($data['type'] == "update"){{$data['name']}}@endif" required>
                                <label class="form-label">Telefon</label>
                                <input class="form-control" type="tel" style="margin-bottom: 25px;" name="phone"
                                       value="@if($data['type'] == "update"){{$data['phone']}}@endif" required>
                            </div>
                            <div class="col-xl-3 col-lg-4">
                                <label class="form-label">IČO</label>
                                <input class="form-control" type="text" style="margin-bottom: 25px;" name="id_number"
                                       value="@if($data['type'] == "update"){{$data['id_number']}}@endif" required>
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" style="margin-bottom: 25px;" name="email"
                                       value="@if($data['type'] == "update"){{$data['email']}}@endif" required>
                            </div>
                            <div class="col-xl-3 col-lg-4">
                                <label class="form-label">DIČ</label>
                                <input class="form-control" type="text" style="margin-bottom: 25px;" name="tax_number"
                                       value="@if($data['type'] == "update"){{$data['tax_number']}}@endif">
                                <label class="form-label">Typ firmy</label>
                                @if($data['type'] == "update")
                                    <input class="form-control" type="text" readonly name="company_type" style="margin-bottom: 25px;"
                                           value="@if($data['comp_type'] == "supplier") Dodavatel
                                                  @elseif($data['comp_type'] == "subscriber") Odběratel @endif">
                                @else
                                    <select id="company_type" name="company_type" style="margin-bottom: 25px;" required>
                                        <option value=""></option>
                                        <option value="supplier">Dodavatel</option>
                                        <option value="subscriber">Odběratel</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 25px;">
                            <div class="col-xl-3 col-lg-4" style="margin-bottom: 25px">
                                <label class="form-label">Fakturační adresa</label>
                                <select placeholder="Vyberte adresu" id="sel_saved_address" name="sel_address"
                                        onchange="onChange_comp_address()" onload="onChange_comp_address()">
                                    <option value=""></option>
                                    <option value="new">* Nová adresa</option>
                                    @foreach($addresses as $address)
                                        <option value="{{$address['id']}}" @if($data['type'] == "update") @if($address['id'] == $data['address_id']) selected @endif @endif>{{$address['street']}}
                                            , {{$address['postal_code']}} {{$address['city']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-4">
                                <label class="form-label">Ulice</label>
                                <input class="form-control new_address_input" name="street" type="text"
                                       style="margin-bottom: 25px;" disabled>
                                <label class="form-label">PSČ</label>
                                <input class="form-control new_address_input" name="postal_code" type="text"
                                       style="margin-bottom: 25px;" disabled>
                            </div>
                            <div class="col-xl-3 col-lg-4">
                                <label class="form-label">Město</label>
                                <input class="form-control new_address_input" name="city" type="text"
                                       style="margin-bottom: 25px;" disabled>
                                <label class="form-label">Stát</label>
                                <input class="form-control new_address_input" name="country" type="text"
                                       style="margin-bottom: 25px;" disabled>
                            </div>
                        </div>
                        <p class="fw-bold">Bankovní spojení</p>
                        <div class="row" style="margin-bottom: 25px;">
                            <div class="col-xl-3 col-lg-4">
                                <input name="bank_id1" hidden value="@if($data['type'] == "update"){{$data['bank_id1']}}@endif">
                                <label class="form-label">Banka 1</label>
                                <input class="form-control" type="text" name="bank_name1" style="margin-bottom: 25px;"
                                       value="@if($data['type'] == "update"){{$data['bank_name1']}}@endif"/>
                                <label class="form-label">Číslo účtu 1</label>
                                <input class="form-control" type="text" name="bank_number1" style="margin-bottom: 25px;"
                                       value="@if($data['type'] == "update"){{$data['bank_number1']}}@endif"/>
                            </div>
                            <div class="col-xl-3 col-lg-4">
                                <input name="bank_id2" hidden value="@if($data['type'] == "update"){{$data['bank_id2']}}@endif">
                                <label class="form-label">Banka 2</label>
                                <input class="form-control" type="text" name="bank_name2" style="margin-bottom: 25px;"
                                       value="@if($data['type'] == "update"){{$data['bank_name2']}}@endif"/>
                                <label class="form-label">Číslo účtu 2</label>
                                <input class="form-control" type="text" name="bank_number2" style="margin-bottom: 25px;"
                                       value="@if($data['type'] == "update"){{$data['bank_number2']}}@endif"/>
                            </div>
                            <div class="col-xl-3 col-lg-4">
                                <input name="bank_id3" hidden value="@if($data['type'] == "update"){{$data['bank_id3']}}@endif">
                                <label class="form-label">Banka 3</label>
                                <input class="form-control" type="text" name="bank_name3" style="margin-bottom: 25px;"
                                       value="@if($data['type'] == "update"){{$data['bank_name3']}}@endif"/>
                                <label class="form-label">Číslo účtu 3</label>
                                <input class="form-control" type="text" name="bank_number3" style="margin-bottom: 25px;"
                                       value="@if($data['type'] == "update"){{$data['bank_number3']}}@endif"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-primary float-end" type="submit">Odeslat<i
                                        class="fa fa-arrow-right" style="margin-left: 10px"></i></button>
                                @if($data['type'] == "update")
                                    <input hidden type="number" name="id" value="{{$data['id']}}">
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @include('layouts.footer')
        </div>

@endsection
