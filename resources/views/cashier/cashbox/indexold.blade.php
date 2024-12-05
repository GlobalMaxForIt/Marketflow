@extends('layouts.cashbox_layout')

@section('title')
    {{translate_title('Checkout', $lang)}}
@endsection
@section('content')
    <style>
        .select2-container {
            z-index: 1055 !important; /* Bootstrap modal uchun z-indexdan yuqori qiymat */
        }
    </style>
    <div class="row">
        <div class="col-3">
            <div id="dragTree">
                <ul>
                    @foreach($allCategriesSubcategoriesProducts as $category)
                        <li>{{$category['category_name']}}
                            <ul>
                                @foreach($category['sub_categories'] as $sub_category)
                                    <li data-jstree='{"opened":true}'>{{$sub_category['sub_category_name']}}
                                        <ul>
                                            @foreach($sub_category['products'] as $product)
                                                <li data-jstree='{"type":"file"}'>
                                                    <a onclick="addToOrder('{{$product['id']}}', '{{$product['name']}}', '{{$product['price']}}', '{{$product['discount']}}', '{{$product['discount_percent']}}', '{{$product['last_price']}}', '{{$product['amount']}}')">
                                                        {{$product['name']}}{{$product['amount']}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-5">
            <div class="main-content-section" id="myDiv">
                <div class="order-section">
                    <div class="card">
                        <div class="card-body overflow-auto">
                            <table class="restaurant_tables datatable table table-striped dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th><h6>{{translate_title('Name', $lang)}}</h6></th>
                                    <th><h6>{{translate_title('Price', $lang)}}</h6></th>
                                    <th><h6>{{translate_title('Stock', $lang)}}</h6></th>
                                    <th><h6>{{translate_title('Functions', $lang)}}</h6></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allProductsData['products'] as $product)
                                    <tr>
                                        <td class="market_tables_text">
                                            <span>{{$product['name']}}</span>
                                            <span>{{$product['amount']}}</span>
                                        </td>
                                        <td class="market_tables_text">
                                            <div><span>{{$product['last_price']}}</span></div>
                                            @if($product['discount']>0)
                                                <del>{{$product['price']}}</del>
                                            @endif
                                        </td>
                                        <td class="market_tables_text">
                                            {{$product['stock']}}
                                        </td>
                                        <td class="market_tables_text">
                                            <a onclick="addToOrder('{{$product['id']}}', '{{$product['name']}}', '{{$product['price']}}', '{{$product['discount']}}', '{{$product['discount_percent']}}', '{{$product['last_price']}}', '{{$product['amount']}}')" class="edit_button btn">
                                                <b><span class="mdi mdi-basket"></span></b>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="carousel-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner" id="carousel_product_images">

                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">{{translate_title('Previous', $lang)}}</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">{{translate_title('Next', $lang)}}</span>
                            </a>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
        <div class="col-4">
            <div class="d-flex justify-content-between mb-2">
                <button class="edit_button btn me-2" data-bs-toggle="modal" data-bs-target="#client_with_discount" id="client_with_discount_button">
                    <b>{{translate_title('Select client with discount', $lang)}}</b>
                </button>
                <button class="edit_button btn me-2" data-bs-toggle="modal" data-bs-target="#general_discount" id="general_discount_button">
                    <b>{{translate_title('Select general discount', $lang)}}</b>
                </button>
            </div>
            <div class="main-content-section">
                <div class="right_options" role="presentation">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th><h6>{{translate_title('Product name', $lang)}}</h6></th>
                            <th><h6>{{translate_title('Qty', $lang)}}</h6></th>
                            <th><h6>{{translate_title('Price', $lang)}}</h6></th>
                            <th><h6>{{translate_title('Total sum', $lang)}}</h6></th>
                            <th><h6>{{translate_title('Functions', $lang)}}</h6></th>
                        </tr>
                        </thead>
                        <tbody id="order_data_content">

                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between padding_20">
                        <h4>{{translate_title('Total:', $lang)}}</h4>
                        <h4 id="total_sum"></h4>
                    </div>
                    <div class="d-flex justify-content-between d-none padding_20 mb-2" id="clientDiscountContent">
                        <div class="d-flex">
                            <h6>{{translate_title('Client discount:', $lang)}}</h6>&nbsp;
                            <span id="clientFullName" class="font_size_12"></span>
                        </div>
                        <div class="d-flex">
                            <a type="button" class="btn delete_button btn-sm waves-effect me-2" id="removeClientDiscount">
                                <img src="{{asset('img/trash_icon.png')}}" alt="" height="18px">
                            </a>
                            <h6 id="clientDiscount" class="color_red"></h6>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between d-none padding_20 mb-2" id="generalDiscountContent">
                        <div class="d-flex">
                            <h6>{{translate_title('General discount:', $lang)}}</h6>&nbsp;
                        </div>
                        <div class="d-flex">
                            <a type="button" class="btn delete_button btn-sm waves-effect me-2" id="removeGeneralDiscountContent">
                                <img src="{{asset('img/trash_icon.png')}}" alt="" height="18px">
                            </a>
                            <h6 id="generalDiscount" class="color_red"></h6>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between d-none padding_20" id="totalLeftSum">
                        <h4>{{translate_title('Total left sum:', $lang)}}</h4>
                        <h4 id="total_left_sum"></h4>
                    </div>
                </div>
                <div class="d-flex add_to_order_buttons_" id="has_items">
                    <div class="width_100_percent d-flex justify-content-between">
                        <a class="modal_close delete_button btn me-2" data-bs-toggle="modal" data-bs-target="#delete_modal_cashbox">
                            <b>{{translate_title('Delete', $lang)}}</b>
                        </a>
                        <a class="modal_confirm btn" onclick="paymentFunc()" data-bs-toggle="modal" data-bs-target="#payment_modal">
                            <b>{{translate_title('Payment', $lang)}}</b>
                        </a>
                    </div>
                </div>
                <div class="d-flex add_to_order_buttons_" id="no_items">
                    <div class="width_100_percent d-flex justify-content-around">
                        <button class="modal_close delete_button btn me-2" data-bs-toggle="modal" data-bs-target="#delete_modal_cashbox" disabled>
                            <b>{{translate_title('Delete', $lang)}}</b>
                        </button>
                        <button class="modal_confirm btn" data-bs-toggle="modal" data-bs-target="#payment_modal" disabled>
                            <b>{{translate_title('Payment', $lang)}}</b>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="delete_modal_cashbox" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled">
                <div class="modal-body">
                    <div class="text-center">
                        <img src="{{asset('img/delete_icon.png')}}" alt="" height="100px">
                        <h4 class="mt-2 delete_text_content">{{ translate_title('Вы уверены, что хотите удалить это?', $lang)}}</h4>
                        <div class="d-flex justify-content-between width_100_percent">
                            <a type="button" class="btn delete_modal_close my-2" data-bs-dismiss="modal"> {{ translate_title('No', $lang)}}</a>
                            <a class="btn delete_modal_confirm my-2" data-bs-dismiss="modal" onclick="truncuateCashboxFunc()"> {{ translate_title('Yes', $lang)}} </a>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="client_with_discount"
         aria-labelledby="staticBackdropLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header card-header">
                    <h5>{{translate_title('Do you want to select client with discount ?', $lang)}}</h5>
                </div>
                <div class="modal-body card-body">
                    <div class="position-relative mb-4">
                        <select class="form-control" name="client_id" data-toggle="select2" data-width="100%" required id="client_select_id_2">
                            <option value="" selected disabled>{{translate_title('Select a client', $lang)}}</option>
                            <optgroup label="Clients">
                                @foreach($clients_for_discount as $client_for_discount)
                                    <option value="{{$client_for_discount['client_id']}} {{$client_for_discount['percent']}} /{{$client_for_discount['client_full_name']}}">{{$client_for_discount['client_full_name']}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Select a client', $lang)}}
                        </div>
                    </div>
                    <div class="d-flex justify-content-between width_100_percent mt-4">
                        <a type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</a>
                        <a class="btn modal_confirm" data-bs-dismiss="modal" id="confirm_client_discount">{{translate_title('Confirm', $lang)}}</a>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="general_discount"
         aria-labelledby="staticBackdropLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="POST">
                @csrf
                @method('POST')
                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item ms-2">
                        <a href="#discount_percent_" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">%</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="#discount_price_" data-bs-toggle="tab" aria-expanded="false" class="nav-link">$</a>
                    </li>
                </ul>
                <div class="tab-content" id="discount_tab">
                    <div class="tab-pane fade show active" id="discount_percent_" role="tabpanel" aria-labelledby="discount_percent_tab">
                        <div class="modal-header card-header">
                            <h5>{{translate_title('Do you want to add general discount percent?', $lang)}}</h5>
                        </div>
                        <div class="modal-body card-body">
                            <div class="position-relative mb-4">
                                <label class="form-label">{{translate_title('Discount percent', $lang)}}</label>
                                <input data-toggle="touchspin" type="number" name="general_discount_percent" id="general_discount_percent" min="0" max="100" data-bts-postfix="%">
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter a general discount percent.', $lang)}}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between width_100_percent mt-4">
                                <a type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</a>
                                <a class="btn modal_confirm" data-bs-dismiss="modal" id="confirm_general_discount_percent">{{translate_title('Confirm', $lang)}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="discount_price_" role="tabpanel" aria-labelledby="discount_price_tab">
                        <div class="modal-header card-header">
                            <h5>{{translate_title('Do you want to add general discount price?', $lang)}}</h5>
                        </div>
                        <div class="modal-body card-body">
                            <div class="position-relative mb-4">
                                <label class="form-label">{{translate_title('Discount price', $lang)}}</label>
                                <input data-toggle="touchspin" type="text" name="general_discount_price" id="general_discount_price" data-bts-max="999999999" data-bts-postfix="$">
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter a general discount price.', $lang)}}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between width_100_percent mt-4">
                                <a type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</a>
                                <a class="btn modal_confirm" data-bs-dismiss="modal" id="confirm_general_discount_price">{{translate_title('Confirm', $lang)}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
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
        let ordered_fail_text = "{{translate_title('Something got wrong. Try again', $lang)}}"
        let service_price_text = "{{translate_title('Service price', $lang)}}"
        let total_price_text = "{{translate_title('Total price', $lang)}}"
        let image_src = "{{asset('icon/no_photo.jpg', $lang)}}"
        let kitchen_index = "{{route('cashbox.index', $lang)}}"
        let json_products = JSON.parse('{!! $allProductsData['json_products'] !!}')
        let page = false

        $(document).ready(function () {
            if($('#client_select_id_2') != undefined && $('#client_select_id_2') != null){
                $('#client_select_id_2').select2({
                    dropdownParent: $('#client_with_discount'), // Modal ID
                    width: '100%' // Select2 dropdownni kengligini moslashtiradi
                });
            }
        })

        // let current_region = ''
        // let current_district = ''
        // if(localStorage.getItem('region_id') != undefined && localStorage.getItem('region_id') != null){
        //     localStorage.removeItem('region_id')
        // }
        // if(localStorage.getItem('district_id') != undefined && localStorage.getItem('district_id') != null){
        //     localStorage.removeItem('district_id')
        // }
        // if(localStorage.getItem('region') != undefined && localStorage.getItem('region') != null){
        //     localStorage.removeItem('region')
        // }
        // if(localStorage.getItem('district') != undefined && localStorage.getItem('district') != null){
        //     localStorage.removeItem('district')
        // }
        //
        // if(localStorage.getItem('delivery_region_id') != undefined && localStorage.getItem('delivery_region_id') != null){
        //     localStorage.removeItem('delivery_region_id')
        // }
        // if(localStorage.getItem('delivery_district_id') != undefined && localStorage.getItem('delivery_district_id') != null){
        //     localStorage.removeItem('delivery_district_id')
        // }
        // if(localStorage.getItem('delivery_region') != undefined && localStorage.getItem('delivery_region') != null){
        //     localStorage.removeItem('delivery_region')
        // }
        // if(localStorage.getItem('delivery_district') != undefined && localStorage.getItem('delivery_district') != null){
        //     localStorage.removeItem('delivery_district')
        // }


    </script>
    {{--    <script src="{{asset('js/cities.js')}}"></script>--}}
    <script src="{{asset('js/ordering.js')}}"></script>
@endsection

