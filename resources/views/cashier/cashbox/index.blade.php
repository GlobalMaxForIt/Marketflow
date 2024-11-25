@extends('layouts.cashbox_layout')

@section('title')
    {{translate_title('Checkout')}}
@endsection
@section('content')
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
                                        <th>{{translate_title('Name')}}</th>
                                        <th>{{translate_title('Price')}}</th>
                                        <th>{{translate_title('Stock')}}</th>
                                        <th>{{translate_title('Functions')}}</th>
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
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
        <div class="col-4">
            <div class="main-content-section">
                <div class="right_options" role="presentation">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{translate_title('Product name')}}</th>
                                <th>{{translate_title('Qty')}}</th>
                                <th>{{translate_title('Price')}}</th>
                                <th>{{translate_title('Total sum')}}</th>
                                <th>{{translate_title('Functions')}}</th>
                            </tr>
                        </thead>
                        <tbody id="order_data_content">

                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between padding_20">
                        <h4>{{translate_title('Total:')}}</h4>
                        <h4 id="total_sum"></h4>
                    </div>
                    <div class="d-flex justify-content-between d-none padding_20 mb-2" id="clientDiscountContent">
                        <div class="d-flex">
                            <h6>{{translate_title('Client discount:')}}</h6>&nbsp;
                            <span id="clientFullName" class="font_size_12"></span>
                        </div>
                        <div class="d-flex">
                            <a type="button" class="btn delete_button btn-sm waves-effect me-2" id="removeClientDiscount">
                                <img src="{{asset('img/trash_icon.png')}}" alt="" height="18px">
                            </a>
                            <h6 id="clientDiscount" class="color_red"></h6>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between d-none padding_20" id="totalLeftSum">
                        <h4>{{translate_title('Total left sum:')}}</h4>
                        <h4 id="total_left_sum"></h4>
                    </div>
                </div>
                <div class="d-flex add_to_order_buttons_" id="has_items">
                    <div class="width_100_percent d-flex justify-content-between">
                        <a class="modal_close delete_button btn me-2" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('product.destroy', $product['id'])}}">
                            <b>{{translate_title('Delete')}}</b>
                        </a>
                        <a class="modal_confirm btn" onclick="paymentFunc()" data-bs-toggle="modal" data-bs-target="#payment_modal">
                            <b>{{translate_title('Payment')}}</b>
                        </a>
                    </div>
                </div>
                <div class="d-flex add_to_order_buttons_" id="no_items">
                    <div class="width_100_percent d-flex justify-content-around">
                        <a class="modal_close delete_button btn me-2" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('product.destroy', $product['id'])}}" disabled>
                            <b>{{translate_title('Delete')}}</b>
                        </a>
                        <a class="modal_confirm btn" onclick="paymentFunc()" data-bs-toggle="modal" data-bs-target="#payment_modal" disabled>
                            <b>{{translate_title('Payment')}}</b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="take_away_modal"
         aria-labelledby="staticBackdropLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog card" role="document">
            <div class="modal-content">
                <div class="modal-header card-header">
                    <h4>{{translate_title('Do you order takeout?')}}</h4>
                </div>
                <div class="modal-body card-body">
                    <div class="tab-content overflow-auto" id="take_away_content">

                    </div>
                    <div class="d-flex justify-content-between width_100_percent mt-4">
                        <a type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close')}}</a>
                        <a onclick="takeAwayConfirm()" class="btn modal_confirm">{{translate_title('Confirm')}}</a>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="client_with_discount"
         aria-labelledby="staticBackdropLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog card" role="document">
            <div class="modal-content">
                <div class="modal-header card-header">
                    <h4>{{translate_title('Do you want to select client with discount ?')}}</h4>
                </div>
                <div class="modal-body card-body">
                    <div class="position-relative mb-4">
                        <select class="form-control" name="client_id" data-toggle="select2" data-width="100%" required id="client_select_id_2">
                            <option value="" selected disabled>{{translate_title('Select a client')}}</option>
                            <optgroup label="Clients">
                                @foreach($clients_for_discount as $client_for_discount)
                                    <option value="{{$client_for_discount['client_id']}} {{$client_for_discount['percent']}} /{{$client_for_discount['client_full_name']}}">{{$client_for_discount['client_full_name']}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Select a client')}}
                        </div>
                    </div>
                    <div class="d-flex justify-content-between width_100_percent mt-4">
                        <a type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close')}}</a>
                        <a class="btn modal_confirm" data-bs-dismiss="modal" id="confirm_client_discount">{{translate_title('Confirm')}}</a>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <script>
        let sum_text =  "{{translate_title('sum')}}"
        let items_text =  "{{translate_title('items')}}"
        let not_found =  "{{translate_title('Not found')}}"
        let phone_text =  "{{translate_title('Phone')}}"
        let image_text =  "{{translate_title('Image')}}"
        let address_text =  "{{translate_title('Address')}}"
        let email_text =  "{{translate_title('Email')}}"
        let gender_text =  "{{translate_title('Gender')}}"
        let notes_text =  "{{translate_title('Notes')}}"
        let ordered_fail_text = "{{translate_title('Something got wrong. Try again')}}"
        let service_price_text = "{{translate_title('Service price')}}"
        let total_price_text = "{{translate_title('Total price')}}"
        let image_src = "{{asset('icon/no_photo.jpg')}}"
        let kitchen_index = "{{route('cashbox.index')}}"
        let json_products = JSON.parse('{!! $allProductsData['json_products'] !!}')
        console.log(json_products)
        let page = false
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

        $(document).ready(function () {
            if($('#client_select_id') != undefined && $('#client_select_id') != null){
                $('#client_select_id').select2({
                    dropdownParent: $('#select_client') // modal ID ni kiriting
                });
            }
            if($('#client_select_id_2').val()){
                confirm_client_discount.disabled = false
            }else{
                confirm_client_discount.disabled = true
            }
            $('#client_select_id_2').select2().on('change', function (e) {
                if($(this).val()){
                    confirm_client_discount.disabled = false
                }else{
                    confirm_client_discount.disabled = true
                }
            })
        })

    </script>
{{--    <script src="{{asset('js/cities.js')}}"></script>--}}
    <script src="{{asset('js/ordering.js')}}"></script>
@endsection

