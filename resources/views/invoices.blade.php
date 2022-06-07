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
                                    <th>Dodavatel</th>
                                    <th>Odběratel</th>
                                    <th>Datum vystavení</th>
                                    <th>Celková cena</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                <tr></tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="/">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" aria-label="Next" href="#"><span aria-hidden="true">»</span></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Patrik Lučný 2022</span></div>
            </div>
        </footer>
    </div>
</div>

@endsection
