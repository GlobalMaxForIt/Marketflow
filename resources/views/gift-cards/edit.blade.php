@extends('layouts.cashier_layout')

@section('title')
    {{translate_title('Edit gift card', $lang)}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt-0 header-title">{{translate_title('Edit gift card', $lang)}}</h4>
                </div>
                <div class="card-body">
                    <form class="modal-body needs-validation" action="{{route('gift-cards.update', $gift_card->id)}}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="position-relative col-6 mb-3">
                                <label for="name" class="form-label">{{translate_title('Coupon name', $lang)}}</label>
                                <input type="text" id="name" class="form-control" name="name" required value="{{$gift_card->name}}">
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter name.', $lang)}}
                                </div>
                            </div>
                            <div class="position-relative col-6 mb-3 mt-4">
                                <div class="form-floating">
                                    <select name="coupon_type" class="form-select" id="coupon_type">
                                        <option value="price" class="form-control" {{$gift_card->price != NULL?'selected':''}}>{{translate_title('Price', $lang)}}</option>
                                        <option value="percent" class="form-control" {{$gift_card->percent != NULL?'selected':''}}>{{translate_title('Percent', $lang)}}</option>
                                    </select>
                                    <label class="form-label">{{translate_title('Select coupon type', $lang)}}</label>
                                </div>
                            </div>
                            <div class="col-6 position-relative mb-3">
                                <div id="coupon_price">
                                    <label class="form-label">{{translate_title('Coupon price', $lang)}}</label>
                                    <input type="number" name="price" class="form-control" id="coupon_price_input" min="0" value="{{$gift_card->price}}"/>
                                </div>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter price.', $lang)}}
                                </div>
                            </div>
                            <div class="col-6 position-relative mb-3">
                                <div class="d-none" id="coupon_percent">
                                    <label class="form-label">{{translate_title('Coupon percent', $lang)}}</label>
                                    <input type="number" name="percent" class="form-control" id="coupon_percent_input" step="0.01" min="0" max="100" value="{{$gift_card->percent??''}}"/>
                                </div>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter percent.', $lang)}}
                                </div>
                            </div>
                            <div class="col-6 position-relative mb-3">
                                <label for="min_price" class="form-label">{{translate_title("Order's min price", $lang)}}</label>
                                <input type="number" name="min_price" id="min_price" class="form-control" min="0" value="{{$gift_card->min_price??''}}"/>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter min price.', $lang)}}
                                </div>
                            </div>
                            <div class="col-6 position-relative mb-3">
                                <label class="form-label">{{translate_title('Range date', $lang)}}</label>
                                <input type="text" name="start_end_date" class="form-control range-datepicker" value="{{$start_end_date}}" placeholder="2018-10-03 to 2018-10-10" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter range date.', $lang)}}
                                </div>
                            </div>
                            <div class="col-6 form-floating mb-3">
                                <select class="form-select" name="status" id="gift_card_status" aria-label="Floating label select example">
                                    <option value="1" {{$gift_card->status != \App\Constants::ACTIVE?'selected':''}}>{{translate_title('Active', $lang)}}</option>
                                    <option value="0" {{$gift_card->status != \App\Constants::NOT_ACTIVE?'selected':''}}>{{translate_title('Not active', $lang)}}</option>
                                </select>
                                <label for="gift_card_status" class="ms-3">{{translate_title('Status', $lang)}}</label>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="d-flex justify-content-end width_100_percent">
                                    <button type="submit" class="btn modal_confirm">{{translate_title('Update', $lang)}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let page = true
        let current_page = 'edit'
        let sessionSuccess ="{{session('status')}}";
        if(sessionSuccess){
            toastr.success(sessionSuccess)
        }
        let sessionError ="{{session('error')}}";
        if(sessionError){
            toastr.warning(sessionError)
        }
        let coupon_price_value = "{{$gift_card->price??''}}"
        let coupon_percent_value = "{{$gift_card->percent??''}}"
    </script>
    <script src="{{asset('js/gift_card.js')}}"></script>
@endsection
