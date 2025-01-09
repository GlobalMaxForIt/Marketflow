@extends('layouts.cashier_layout')

@section('title')
    {{translate_title('Edit cashback type', $lang)}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt-0 header-title">{{translate_title('Edit cashback type', $lang)}}</h4>
                </div>
                <div class="card-body">
                    <form class="modal-body needs-validation" action="{{route('cashback-type.update', $cashback_type->id)}}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="position-relative col-6 mb-3">
                                <label for="name" class="form-label">{{translate_title('Name', $lang)}}</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{$cashback_type->name}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter name.', $lang)}}
                                </div>
                            </div>
                            <div class="position-relative col-6 mb-3">
                                <label for="percent" class="form-label">{{translate_title('Percent', $lang)}}</label>
                                <input data-toggle="touchspin" type="number" name="percent"  value="{{$cashback_type->percent}}" min="0" max="100" data-bts-postfix="%" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter percent.', $lang)}}
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
