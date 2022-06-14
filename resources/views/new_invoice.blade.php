@extends('layouts.master')

@section('content')

<div id="wrapper">
    @include('layouts.navbar')
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid" style="padding-top: 24px;">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Vytvořit faktury</h3>
                </div>
            </div>
            <form action="create_invoice" onsubmit="return sendProducts()" method="POST">
                @csrf
                <div class="container" style="margin-bottom: 35px;">
                    <div class="row">
                        <div class="col-md-6 col-xl-6 offset-xl-0">
                            <h4>Dodavatel</h4>
                            <select style="width: 70%;margin-bottom: 30px;" placeholder="Vyberte dodavatele" name="supplier" required onchange="onChange_supplier()" id="select-supp">
                                <option value=""></option>
                                @foreach($data['suppliers'] as $supplier)
                                    <option value="{{$supplier['id']}}">{{$supplier['name']}}</option>
                                @endforeach
                            </select>
                            <p style="line-height: 30px; margin-top: 30px" id="supplier-address">Ulice a č.p.<br>PSČ - Město<br>Stát</p>
                        </div>
                        <div class="col-md-6 col-xl-6 offset-xl-0">
                            <h4>Odběratel</h4>
                            <select style="width: 70%;margin-bottom: 30px;" placeholder="Vyberte odběratele" name="subscriber" required onchange="onChange_subscriber()" id="select-subs">
                                <option value=""></option>
                                @foreach($data['subscribers'] as $subscriber)
                                    <option value="{{$subscriber['id']}}">{{$subscriber['name']}}</option>
                                @endforeach
                            </select>
                            <p style="line-height: 30px; margin-top: 30px" id="subscriber-address">Ulice a č.p.<br>PSČ - Město<br>Stát</p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <h4>Produkty</h4>
                                <div class="table-responsive" id="products_table">
                                    <table class="table" id="products_table">
                                        <thead>
                                        <tr>
                                            <th>Počet</th>
                                            <th>Název</th>
                                            <th style="text-align: right;">Cena za kus (s DPH)</th>
                                            <th style="text-align: right;">Cena (s DPH)</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody id="products_table_body"></tbody>
                                    </table>
                                    <input type="hidden" name="products" id="list_of_products" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="d-flex flex-wrap" style="margin-bottom: 40px;">
                                    <input type="number" placeholder="Počet" style="margin-right: 30px;" id="add_product_quantity">
                                    <select style="width: 300px;margin-right: 30px;" placeholder="Vyberte produkt" id="add_product_name">
                                        <option value=""></option>
                                        @foreach($data['products'] as $product)
                                            <option value="{{$product['id']}}">{{$product['name']}}</option>
                                        @endforeach
                                    </select>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-32 0 512 512" width="1em" height="1em" fill="currentColor" style="height: 30px;width: 30px; margin-left: 30px" onclick="addProduct()">
                                        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                        <path d="M384 32C419.3 32 448 60.65 448 96V416C448 451.3 419.3 480 384 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H384zM224 368C237.3 368 248 357.3 248 344V280H312C325.3 280 336 269.3 336 256C336 242.7 325.3 232 312 232H248V168C248 154.7 237.3 144 224 144C210.7 144 200 154.7 200 168V232H136C122.7 232 112 242.7 112 256C112 269.3 122.7 280 136 280H200V344C200 357.3 210.7 368 224 368z"></path>
                                    </svg>
                                </div>
                                <button class="btn btn-primary float-end" type="submit">Vytvořit fakturu<i
                                        class="fa fa-arrow-right" style="margin-left: 10px;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @include('layouts.footer')
    </div>
</div>

@endsection
