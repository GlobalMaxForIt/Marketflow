@extends('layouts.cashier_layout')

@section('title')
    {{translate_title('Bills', $lang)}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section p_right_0">
            <!-- Tab panes -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item ms-2 mb-2" role="presentation">
                    <a class="nav-link active font-14" id="bills_history-tab" data-bs-toggle="tab" href="#payment_history" role="tab" aria-controls="bills_history" aria-selected="true">
                        {{translate_title('Payment history', $lang)}}
                    </a>
                </li>
                <li class="nav-item ms-2 mb-2" role="presentation">
                    <a class="nav-link font-14" id="opened_bills-tab" data-bs-toggle="tab" href="#returned_back_history" role="tab" aria-controls="opened_bills" aria-selected="false">
                        {{translate_title('Returned back history', $lang)}}
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="payment_history" role="tabpanel" aria-labelledby="payment_history-tab">
                    <div class="row">
                        <div class="card col-8">
                            <div class="card-body overflow-auto">
                                <div class="d-flex justify-content-end">
                                    <input class="payment_sort_by_date form-control me-5" id="payment_input_month" type="month" name="month">
                                    <input class="payment_sort_by_date form-control" id="payment_input_date" type="date" name="date">
                                </div>
                                <table class="restaurant_tables table table-striped table-bordered dt-responsive nowrap" id="datatable-buttons">
                                    <thead>
                                        <tr>
                                            <th><h6>{{translate_title('Total amount', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Paid amount', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Returning amount', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Code', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Updated at', $lang)}}</h6></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($all_sales as $key => $all_sale)
                                            <tr class="bill_info_table" onclick="showBillInfo(this, `{{ json_encode($all_sales_info[$key]) }}`, `{{ json_encode($all_sales_gift_card[$key]) }}`, `{{$all_sale['code']}}`, `{{$all_sale['price']}}`, `{{$all_sale['discount_price']}}`, `{{$all_sale['total_amount']}}`, `{{$all_sale['return_amount']}}`, `{{$all_sale['id']}}`, `{{$all_sale['client_full_name']}}`, `{{$all_sale['client_discount_price']}}`)">
                                                <td><h6>{{$all_sale['total_amount'].' '.translate_title('sum', $lang)}}</h6></td>
                                                <td><h6>{{$all_sale['paid_amount'].' '.translate_title('sum', $lang)}}</h6></td>
                                                <td><h6>{{$all_sale['return_amount'].' '.translate_title('sum', $lang)}}</h6></td>
                                                <td><h6>{{$all_sale['code']}}</h6></td>
                                                <td><h6>{{$all_sale['updated_at']}}</h6></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-4 d-flex flex-column">
                            <div class="main-content-section_bills">
                                <div class="right_options bill_right_option" role="presentation" id="product_full_info_alert">
                                    <div class="d-flex justify-content-start mb-2">
                                        <h5 id="payment_history_code"></h5>
                                    </div>
                                    <div class="nav flex-column" id="payment_history_data">

                                    </div>
                                </div>
                            </div>
                            <div class="bills_history_content">
                                <div class="d-flex justify-content-between">
                                    <h6 class="order-info-title"> {{translate_title('Подитог', $lang)}}</h6>
                                    <div>
                                        <h6 class="order-info-sum" id="bills_history_subtotal">0 000 000 {{translate_title('sum', $lang)}}</h6>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between" id="popover-container">
                                    <a class="order-info-title" id="client_title_text" tabindex="0" data-bs-container="#popover-container" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="good" data-original-title=""> {{translate_title('Скидка клиента', $lang)}}</a>
                                    <h6 class="order-info-sum" id="bills_history_client">0 000 000 {{translate_title('sum', $lang)}}</h6>
                                </div>
                                <div class="d-flex justify-content-between d-none" id="bills_history_gift_card">
                                    <h6 class="order-info-title">{{translate_title('Gift card', $lang)}}</h6>
                                    <h6 class="order-info-sum">0 000 000 {{translate_title('sum', $lang)}}</h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="order-info-title">{{translate_title('Скидка', $lang)}}</h6>
                                    <h6 class="order-info-sum" id="bills_history_discount">0 000 000 {{translate_title('sum', $lang)}}</h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="order-info"> {{translate_title('Итог', $lang)}}</h6>
                                        <h6 class="order-info d-none" id="return_total_amount_text"> {{translate_title('Return', $lang)}}</h6>
                                    </div>
                                    <div>
                                        <h6 class="order-info" id="bills_history_total">0 000 000 {{translate_title('sum', $lang)}}</h6>
                                        <h6 class="order-info-sum d-none" id="return_total_amount">0 000 000 {{translate_title('sum', $lang)}}</h6>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end d-none" id="return_modal_button">
                                    <button class="modal_confirm_pay_ btn"  data-bs-toggle="modal" data-bs-target="#return_modal">
                                        <h6 class="color_white mb-0">{{translate_title('Return', $lang)}}</h6>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="returned_back_history" role="tabpanel" aria-labelledby="returned_back_history-tab">
                    <div class="row">
                        <div class="card col-8">
                            <div class="card-body overflow-auto">
                                <table class="restaurant_tables datatable table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th><h6>{{translate_title('Price', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Code', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Updated at', $lang)}}</h6></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($all_sales_modal as $key => $all_sale_modal)
                                        <tr class="return_bill_info_table" onclick="showBillInfoModal(this, `{{ json_encode($all_sales_info_modal[$key]) }}`, `{{ json_encode($all_sales_info_gift_card[$key]) }}`, `{{$all_sale_modal['code']}}`, `{{$all_sale_modal['price']}}`, `{{$all_sale_modal['id']}}`, `{{$all_sale_modal['client_full_name']}}`)">
                                            <td><h6>{{$all_sale_modal['price'].' '.translate_title('sum', $lang)}}</h6></td>
                                            <td><h6>{{$all_sale_modal['code']}}</h6></td>
                                            <td><h6>{{$all_sale_modal['updated_at']}}</h6></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-4 d-flex flex-column">
                            <div class="main-content-section_bills">
                                <div class="right_options bill_right_option" role="presentation" id="product_full_info_alert">
                                    <div class="d-flex justify-content-start mb-2">
                                        <h5 id="returned_back_history_code"></h5>
                                    </div>
                                    <div class="nav flex-column" id="returned_back_history_data">

                                    </div>
                                </div>
                            </div>
                            <div class="bills_history_content">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="order-info d-none" id="returned_back_total_amount_text"> {{translate_title('Return', $lang)}}</h6>
                                    </div>
                                    <div>
                                        <h6 class="order-info-sum d-none" id="returned_back_total_amount">0 000 000 {{translate_title('sum', $lang)}}</h6>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between d-none" id="return_back_history_gift_card">
                                    <div>
                                        <h6 class="order-info"> {{translate_title('Return', $lang)}}</h6>
                                    </div>
                                    <div>
                                        <h6 class="order-info-sum">0 000 000 {{translate_title('sum', $lang)}}</h6>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end d-none" id="returned_back_modal_button">
                                    <button class="modal_confirm_pay_ btn"  data-bs-toggle="modal" data-bs-target="#returned_back_modal">
                                        <h6 class="color_white mb-0">{{translate_title('Cancell', $lang)}}</h6>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="return_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="return_modal-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled">
                <div class="modal-body">
                    <div class="text-center">
                        <img src="{{asset('img/delete_icon.png')}}" alt="" height="100px">
                        <h4 class="mt-2 delete_text_content">{{ translate_title('Вы уверены, что хотите возврат?', $lang)}} <h4 id="return_modal_title"> </h4></h4>
                        <div class="modal-body" id="return_modal_body">

                        </div>
                        <div class="d-flex justify-content-around">
                            <a type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ translate_title('Close', $lang) }}</a>
                            <a type="button" class="btn btn-success" id="return_modal_button_click">{{ translate_title('Confirm', $lang) }}</a>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="returned_back_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="returned_back_modal-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled">
                <div class="modal-body">
                    <div class="text-center">
                        <img src="{{asset('img/delete_icon.png')}}" alt="" height="100px">
                        <h4 class="mt-2 delete_text_content">{{ translate_title('Вы уверены, что хотите возврат?', $lang)}} <h4 id="returned_back_modal_title"> </h4></h4>
                        <div class="modal-body" id="returned_back_modal_body">

                        </div>
                        <div class="d-flex justify-content-around">
                            <a type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ translate_title('Close', $lang) }}</a>
                            <a type="button" class="btn btn-success" id="return_modal_button_click">{{ translate_title('Confirm', $lang) }}</a>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        let sum_text =  "{{translate_title('sum', $lang)}}"
        let left_text =  "{{translate_title('are left', $lang)}}"
        let items_text =  "{{translate_title('items', $lang)}}"
        let not_found =  "{{translate_title('Not found', $lang)}}"
        let phone_text =  "{{translate_title('Phone', $lang)}}"
        let image_text =  "{{translate_title('Image', $lang)}}"
        let address_text =  "{{translate_title('Address', $lang)}}"
        let email_text =  "{{translate_title('Email', $lang)}}"
        let gender_text =  "{{translate_title('Gender', $lang)}}"
        let notes_text =  "{{translate_title('Notes', $lang)}}"
        let taken_back_text =  "{{translate_title('Taken back', $lang)}}"
        let return_icon = "{{asset('img/return.svg')}}"
        let page_name = 'payment'
        let token = "{{$user->token}}"
        let return_success_text = "{{translate_title('Возврат сделан', $lang)}}"
        let return_modal_title = document.getElementById('return_modal_title')
        let returned_back_modal_title = document.getElementById('returned_back_modal_title')
        let order_selected_product_name = ''
        let order_selected_product_info = ''
        let payment_pay_url = "{{route('paymentPay')}}"
        let gift_card_url = "{{route('giftCard')}}"
        let get_check_aside_url = "{{route('getCheckAside')}}"
        let cashbox_big_url = "{{route('confirmReturn')}}"
    </script>
    <script>
        let payment_input_month = document.getElementById('payment_input_month')
        let payment_input_date = document.getElementById('payment_input_date')
        payment_input_month.addEventListener('change', function (e) {
            setTimeout(function () {
                $('#datatable-buttons').DataTable().search(e.target.value).draw();
            }, 144)
        })
        payment_input_date.addEventListener('change', function (e) {
            setTimeout(function () {
                $('#datatable-buttons').DataTable().search(e.target.value).draw();
            }, 144)
        })

    </script>
@endsection
