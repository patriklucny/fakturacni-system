@extends('layouts.master')

@section('content')

    <div id="wrapper">
        @include('layouts.navbar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" class="vertical-center" style="padding-top: 25px;padding-right: 80px;padding-left: 80px;">
                <div class="container">
                    <h1 class="text-center d-xl-flex justify-content-xl-center align-items-xl-end">Vítejte ve fakturačním systému.</h1>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>

@endsection





