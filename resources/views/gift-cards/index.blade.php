@extends('layouts.cashier_layout')
@section('title')
    {{translate_title('Gift cards', $lang)}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section">
            <div class="card">
                <div class="right_button_create">
                    <a class="form_functions global-button" data-bs-toggle="modal" data-bs-target="#create_modal" data-url="{{route('gift-cards.create')}}">
                        <img src="{{asset('img/client_icon.png')}}" alt="" height="20px">
                        {{translate_title('New gift card', $lang)}}
                    </a>
                </div>
                <div class="card-body overflow-auto">
                    <table id="datatable-buttons" class="restaurant_tables table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th><h6>{{translate_title('Id', $lang)}}</h6></th>
                                <th><h6>{{translate_title('Name', $lang)}}</h6></th>
                                <th><h6>{{translate_title('Value', $lang)}}</h6></th>
                                <th><h6>{{translate_title('Minimum price', $lang)}}</h6></th>
                                <th><h6>{{translate_title('status', $lang)}}</h6></th>
                                <th><h6>{{translate_title('Functions', $lang)}}</h6></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($gift_cards as $gift_card)
                            <tr>
                                <td><h6>{{$gift_card['id']}}</h6></td>
                                <td><h6>{{$gift_card['name']}}</h6></td>
                                <td><h6>{{$gift_card['price']}}</h6></td>
                                <td><h6>{{$gift_card['min_price']}}</h6></td>
                                <td><h6>{{$gift_card['status']}}</h6></td>
                                <td>
                                    <div class="d-flex justify-content-around align-items-center height_50 function_buttons">
                                        <a class="edit_button btn" href="{{route('gift-cards.edit', $gift_card['id'])}}">
                                            <img src="{{asset('img/edit_icon.png')}}" alt="" height="18px">
                                        </a>
                                        <a type="button" class="btn delete_button btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('gift-cards.destroy', $gift_card['id'])}}">
                                            <img src="{{asset('img/trash_icon.png')}}" alt="" height="18px">
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="create_modal"
         aria-labelledby="scrollableModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('New gift card', $lang)}}</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <form class="modal-body needs-validation" action="{{route('gift-cards.store', $lang)}}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('POST')
                    <div class="position-relative mb-3">
                        <label for="name" class="form-label">{{translate_title('Coupon name', $lang)}}</label>
                        <input type="text" id="name" class="form-control" name="name" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter name.', $lang)}}
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <div class="form-floating">
                            <select name="coupon_type" class="form-select" id="coupon_type">
                                <option value="price" class="form-control">{{translate_title('Price', $lang)}}</option>
                                <option value="percent" class="form-control">{{translate_title('Percent', $lang)}}</option>
                            </select>
                            <label class="form-label">{{translate_title('Select coupon type', $lang)}}</label>
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <div id="coupon_price">
                            <label class="form-label">{{translate_title('Coupon price', $lang)}}</label>
                            <input type="number" name="price" class="form-control" id="coupon_price_input" min="0" value="{{old('price')}}"/>
                        </div>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter price.', $lang)}}
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <div class="d-none" id="coupon_percent">
                            <label class="form-label">{{translate_title('Coupon percent', $lang)}}</label>
                            <input type="number" name="percent" class="form-control" id="coupon_percent_input" step="0.01" min="0" max="100" disabled value="{{old('percent')}}"/>
                        </div>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter percent.', $lang)}}
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label for="min_price" class="form-label">{{translate_title("Order's min price", $lang)}}</label>
                        <input type="number" name="min_price" id="min_price" class="form-control" min="0" value="{{old('min_price')}}"/>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter min price.', $lang)}}
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label class="form-label">{{translate_title('Range date', $lang)}}</label>
                        <input type="text" name="start_end_date" class="form-control range-datepicker" value="{{old('start_end_date')}}" placeholder="2018-10-03 to 2018-10-10" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter range date.', $lang)}}
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="status" id="floatingSelect" aria-label="Floating label select example">
                            <option value="1">{{translate_title('Active', $lang)}}</option>
                            <option value="0">{{translate_title('Not active', $lang)}}</option>
                        </select>
                        <label for="floatingSelect">{{translate_title('Status', $lang)}}</label>
                    </div>
                    <div class="d-flex justify-content-between width_100_percent">
                        <a type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</a>
                        <button type="submit" class="btn modal_confirm">{{translate_title('Create', $lang)}}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <script>
        let page = false
        let current_page = 'index'
        let coupon_price_value = ""
        let coupon_percent_value = ""
        let sessionSuccess ="{{session('status')}}";
        if(sessionSuccess){
            toastr.success(sessionSuccess)
        }
        let sessionError ="{{session('error')}}";
        if(sessionError){
            toastr.warning(sessionError)
        }
    </script>
    <script src="{{asset('js/gift_card.js')}}"></script>
    <script src="{{asset('js/datatables_style.js')}}"></script>
@endsection
