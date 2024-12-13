@extends('layouts.cashier_layout')

@section('title')
    {{translate_title('Bills', $lang)}}
@endsection
@section('content')

    <div class="main-content-section">
        <div class="order-section p_right_0">
            <!-- Tab panes -->
            <div id="bills_history">
                <div class="row">
                    <div class="card col-8">
                        <div class="card-body overflow-auto">
                            <table class="restaurant_tables datatable table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th><h6>{{translate_title('Total amount', $lang)}}</h6></th>
                                        <th><h6>{{translate_title('Paid amount', $lang)}}</h6></th>
                                        <th><h6>{{translate_title('Returning amount', $lang)}}</h6></th>
                                        <th><h6>{{translate_title('Updated at', $lang)}}</h6></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($all_sales as $key => $all_sale)
                                        <tr class="bill_info_table" onclick="showBillInfo(this, {{ json_encode($all_sales_info[$key]) }}, `{{$all_sale['price']}}`, `{{$all_sale['discount_price']}}`, `{{$all_sale['total_amount']}}`, `{{$all_sale['return_amount']}}`, `{{$all_sale['id']}}`, `{{$all_sale['client_full_name']}}`, `{{$all_sale['client_discount_price']}}`)">
                                            <td><h6>{{$all_sale['total_amount']}}</h6></td>
                                            <td><h6>{{$all_sale['paid_amount']}}</h6></td>
                                            <td><h6>{{$all_sale['return_amount']}}</h6></td>
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
                                <div class="text-start"><span id="bills_history_code"></span></div>
                                <div class="nav flex-column" id="bills_history_data">

                                </div>
                            </div>
                        </div>
                        <div class="bills_history_content">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="order-info-title"> {{translate_title('Подитог', $lang)}}</h6>
                                <h6 class="order-info-sum" id="bills_history_subtotal">0 000 000 {{translate_title('sum', $lang)}}</h6>
                            </div>
                            <div class="d-flex justify-content-between mb-2" id="popover-container">
                                <a class="order-info-title" id="client_title_text" tabindex="0" data-bs-container="#popover-container" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="good" data-original-title=""> {{translate_title('Скидка клиента', $lang)}}</a>
                                <h6 class="order-info-sum" id="bills_history_client">0 000 000 {{translate_title('sum', $lang)}}</h6>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="order-info-title">{{translate_title('Скидка', $lang)}}</h6>
                                <h6 class="order-info-sum" id="bills_history_discount">0 000 000 {{translate_title('sum', $lang)}}</h6>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="order-info"> {{translate_title('Итог', $lang)}}</h6>
                                <h6 class="order-info" id="bills_history_total">0 000 000 {{translate_title('sum', $lang)}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <script>
        let sum_text =  "{{translate_title('sum', $lang)}}"
        let items_text =  "{{translate_title('items', $lang)}}"
        let not_found =  "{{translate_title('Not found', $lang)}}"
        let phone_text =  "{{translate_title('Phone', $lang)}}"
        let image_text =  "{{translate_title('Image', $lang)}}"
        let address_text =  "{{translate_title('Address', $lang)}}"
        let email_text =  "{{translate_title('Email', $lang)}}"
        let gender_text =  "{{translate_title('Gender', $lang)}}"
        let notes_text =  "{{translate_title('Notes', $lang)}}"
    </script>
    <script src="{{asset('js/bills.js')}}"></script>
    <script>
        // let bills_history_th = document.querySelector('#bills_history th')
        // let opened_bills_th = document.querySelector('#opened_bills th')
        // let closed_bills_th = document.querySelector('#closed_bills th')
        // let pay_off_debt_th = document.querySelector('#pay_off_debt th')
        // setTimeout(function () {
        //     bills_history_th.click()
        //     opened_bills_th.click()
        //     closed_bills_th.click()
        //     pay_off_debt_th.click()
        // }, 1000)
    </script>
@endsection
