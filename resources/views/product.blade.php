@extends('layouts.master')

@section('content')

    <div id="wrapper">
        @include('layouts.navbar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" style="padding-top: 25px;padding-right: 80px;padding-left: 80px;">
                <div class="container">
                    <div class="row">
                        <div class="col" style="margin-bottom: 25px;">
                            <h1>Produkt</h1>
                        </div>
                    </div>
                </div>
                <form action="@if($data['type'] == "update") update_product @else new_product @endif" method="POST">
                    @csrf
                    <div class="container">
                        <div class="row" style="margin-bottom: 25px;">
                            <div class="col-xl-5 col-lg-6">
                                <label class="form-label">Název</label>
                                <input class="form-control" type="text" name="name" style="margin-bottom: 30px;" value="@if($data['type'] == "update"){{$data['name']}}@endif"/>
                                <label class="form-label">Daň</label>
                                <input class="form-control" type="number" name="tax" style="margin-bottom: 30px;" value="@if($data['type'] == "update"){{$data['tax']}}@endif"/>
                            </div>
                            <div class="col-xl-5 col-lg-6">
                                <label class="form-label">Cena (s DPH)</label>
                                <input class="form-control" type="number" name="price" style="margin-bottom: 30px;" value="@if($data['type'] == "update"){{$data['price']}}@endif"/>
                                <label class="form-label">Záruka (v měsících)</label>
                                <input class="form-control" type="number" name="warranty" style="margin-bottom: 30px;" value="@if($data['type'] == "update"){{$data['warranty']}}@endif"/>
                                @if($data['type'] == "update") <input hidden type="number" name="id" value="{{$data['id']}}"> @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-primary float-end" type="submit">Odeslat<i
                                        class="fa fa-arrow-right" style="margin-left: 10px;"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @include('layouts.footer')
        </div>
    </div>

@endsection





