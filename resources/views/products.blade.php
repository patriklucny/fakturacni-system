@extends('layouts.master')

@section('content')

<div id="wrapper">
    @include('layouts.navbar')
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid"><h3 class="text-dark mb-4" style="margin-top: 24px;">Produkty</h3>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive table mt-2" id="dataTable" role="grid"
                             aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Produkt</th>
                                    <th>Záruka (v měsících)</th>
                                    <th>Daň</th>
                                    <th>Cena (s DPH)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $product)
                                    <tr onclick="openProduct({{$product['id']}})" class="pointer table_invoice_row">
                                        <td>{{$product['id']}}</td>
                                        <td>{{$product['name']}}</td>
                                        <td>{{$product['warranty']}}</td>
                                        <td>{{$product['tax']}} %</td>
                                        <td>{{$product['price']}} Kč</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>

@endsection
