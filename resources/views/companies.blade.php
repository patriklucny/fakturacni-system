@extends('layouts.master')

@section('content')

<div id="wrapper">
    @include('layouts.navbar')
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">
                <h3 class="text-dark mb-4" style="margin-top: 24px;">Firmy</h3>
                <div class="container">
                    <div class="row" style="margin-bottom: 25px;">
                        <div class="col-xl-6">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                         aria-describedby="dataTable_info">
                                        <table class="table my-0" id="dataTable">
                                            <thead>
                                            <tr>
                                                <th>Dodavatelé</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($suppliers as $supplier)
                                                <tr onclick="openCompany({{$supplier['id']}}, 'supplier')" class="pointer table_invoice_row">
                                                    <td>{{$supplier['name']}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 ">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                        <table class="table my-0" id="dataTable">
                                            <thead>
                                            <tr>
                                                <th>Odběratelé</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($subscribers as $subscriber)
                                                <tr onclick="openCompany({{$subscriber['id']}}, 'subscriber')" class="pointer table_invoice_row">
                                                    <td>{{$subscriber['name']}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>

@endsection
