@extends('layout.layout')

@section('title')
    {{-- Your page title --}}
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <p class="text-muted font-14">
                {{translate_title('Coupon list create', $lang)}}
            </p>
            <form action="{{route('gift-cards.store')}}" class="parsley-examples" method="POST" enctype="multipart/form-data">
                @csrf
                @method("POST")
                <div class="row">
                    <div class="mb-3 col-4">
                        <label class="form-label">{{translate_title('Coupon name', $lang)}}</label>
                        <input type="text" name="name" class="form-control" required value="{{old('name')}}"/>
                    </div>
                    <div class="mb-3 col-4">
                        <label class="form-label">{{translate_title('Coupon type', $lang)}}</label>
                        <select name="coupon_type" class="form-control" id="coupon_type">
                            <option value="price" class="form-control">{{translate_title('Price', $lang)}}</option>
                            <option value="percent" class="form-control">{{translate_title('Percent', $lang)}}</option>
                        </select>
                    </div>
                    <div class="mb-3 col-4" id="coupon_price">
                        <label class="form-label">{{translate_title('Coupon price', $lang)}}</label>
                        <input type="number" name="price" class="form-control" id="coupon_price_input"  min="0" value="{{old('price')}}"/>
                    </div>
                    <div class="mb-3 col-4 display-none" id="coupon_percent">
                        <label class="form-label">{{translate_title('Coupon percent', $lang)}}</label>
                        <input type="number" name="percent" class="form-control" id="coupon_percent_input" step="0.01" min="0" max="100" value="{{old('percent')}}"/>
                    </div>
                    <div class="mb-3 col-4">
                        <label class="form-label">{{translate_title("Order's min price", $lang)}}</label>
                        <input type="number" name="min_price" class="form-control" min="0" value="{{old('min_price')}}"/>
                    </div>
                    <div class="mb-3 col-4">
                        <label class="form-label">{{translate_title('Coupon quantity or number', $lang)}}</label>
                        <select name="coupon__type" class="form-control" id="coupon__type">
                            <option value="quantity" class="form-control">{{translate_title('Quantity', $lang)}}</option>
                            <option value="number" class="form-control">{{translate_title('Number', $lang)}}</option>
                        </select>
                    </div>
                    <div class="mb-3 col-4" id="coupon_quantity">
                        <label class="form-label">{{translate_title('Quntity of orders', $lang)}}</label>
                        <input type="number" name="order_quantity" class="form-control" id="coupon_quantity_input"/>
                    </div>
                    <div class="mb-3 col-4 display-none" id="coupon_number">
                        <label class="form-label">{{translate_title('Number of order', $lang)}}</label>
                        <input type="number" name="order_number" class="form-control" id="coupon_number_input"/>
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label">{{translate_title('Start date', $lang)}}</label>
                        <input type="date" name="start_date" class="form-control" required value="{{old('start_date')}}"/>
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label">{{translate_title('End date', $lang)}}</label>
                        <input type="date" name="end_date" class="form-control" required value="{{old('end_date')}}"/>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">{{translate_title('Create', $lang)}}</button>
                    <button type="reset" class="btn btn-secondary waves-effect">{{translate_title('Cancel', $lang)}}</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
    <script>
        let coupon_price_value = ""
        let coupon_percent_value = ""
        let coupon_quantity_value = ""
        let coupon_number_value = ""
    </script>
    <script src="{{asset('assets/js/coupon.js')}}"></script>
@endsection
