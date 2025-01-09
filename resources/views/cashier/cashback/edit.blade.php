@extends('layouts.cashier_layout')

@section('title')
    {{translate_title('Edit client', $lang)}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt-0 header-title">{{translate_title('Edit cashback type', $lang)}}</h4>
                </div>
                <div class="card-body">
                    <form class="modal-body needs-validation" action="{{route('cashback-type.update', $client->id)}}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="position-relative col-6 mb-3">
                                <label for="name" class="form-label">{{translate_title('Name', $lang)}}</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{$client->name}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter name.', $lang)}}
                                </div>
                            </div>
                            <div class="position-relative col-6 mb-3">
                                <label for="surname" class="form-label">{{translate_title('Surname', $lang)}}</label>
                                <input type="text" id="surname" class="form-control" name="surname" value="{{$client->surname}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter surname.', $lang)}}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end width_100_percent">
                            <button type="submit" class="btn modal_confirm">{{translate_title('Update', $lang)}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
