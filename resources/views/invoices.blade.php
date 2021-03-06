@extends('layouts.master')

@section('content')

<div id="wrapper">
    @include('layouts.navbar')
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid"><h3 class="text-dark mb-4" style="margin-top: 24px;">Vytvořené faktury</h3>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive table mt-2" id="dataTable" role="grid"
                             aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Dodavatel</th>
                                    <th>Odběratel</th>
                                    <th>Datum vystavení</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $invoice)
                                    <tr onclick="openInvoice({{$invoice['id']}})" class="pointer table_invoice_row">
                                        <td>{{$invoice['number']}}</td>
                                        <td>{{$invoice['supplier']['name']}}</td>
                                        <td>{{$invoice['subscriber']['name']}}</td>
                                        <td>{{$invoice['create_date']}}</td>
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
