@extends('layouts.cashier_large_layout')

@section('title')
    {{translate_title('Checkout', $lang)}}
@endsection
@section('content')
    <style>
        .select2-container {
            z-index: 1055 !important; /* Bootstrap modal uchun z-indexdan yuqori qiymat */
        }
        .key_big h6, .key_big_space h6{
            margin: 0px !important;
        }
        .accordion-button{
            padding: 7px;
        }
    </style>
    <div class="row">
        <div class="col-8">
            <div class="main-content-section">
                <div class="order-section">
                    <div class="card">
                        <div class="card-body overflow-auto">
                            <h6 class="d-none" id="check_code"></h6>
                            <table id="popover-container" class="tablesaw table mb-0" data-tablesaw-mode="swipe" data-tablesaw-mode-switch
                                   data-tablesaw-minimap>
                                <thead>
                                    <tr>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">
                                            <h6><b>{{translate_title('Barcode', $lang)}}</b></h6>
                                        </th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col
                                            data-tablesaw-priority="3"><h6><b>{{translate_title('Name', $lang)}}</b></h6>
                                        </th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2"><h6><b>{{translate_title('Price', $lang)}}</b></h6></th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col
                                            data-tablesaw-priority="3"><h6><b>{{translate_title('Qty', $lang)}}</b></h6>
                                        </th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1"><h6><b>{{translate_title('Sum', $lang)}}</b></h6></th>
                                    </tr>
                                </thead>

                                <tbody id="order_data_content">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 ps-2">
{{--            <div class="d-flex justify-content-between mb-2">--}}
{{--                <button class="edit_button btn me-2" data-bs-toggle="modal" data-bs-target="#client_with_discount" id="client_with_discount_button">--}}
{{--                    <b>{{translate_title('Select client with discount', $lang)}}</b>--}}
{{--                </button>--}}
{{--            </div>--}}
            <div class="main-content-section">

                <div class="tab-content" id="myCategory">
                    <div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="products-tab">
                        <ul class="nav nav-tabs mb-2">
                            <li class="nav-item ms-2 mb-2">
                                <a href="#client_modal" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                    {{translate_title("Client", $lang)}}
                                </a>
                            </li>
                            <li class="nav-item ms-2 mb-2">
                                <a href="#fast_selling_goods_modal" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                    {{translate_title('Fast selling goods', $lang)}}
                                </a>
                            </li>
                            <li class="nav-item ms-2 mb-2">
                                <a href="#list_aside_the_check" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                    {{translate_title('List aside the check', $lang)}}
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myCategory_">
                            <div class="tab-pane fade show active" id="client_modal" role="tabpanel" aria-labelledby="client_modal-tab">
                                <div class="right_options" role="presentation">
                                    <div>
                                        <div class="payment-content-header">
                                            <div class="payment-content-header_title mb-3">
                                                <span class="payment-content-header-title_name">
                                                    <h6>{{translate_title('Client', $lang)}}</h6>
                                                </span>
                                                <a class="payment-content-header-title_button" data-bs-toggle="modal" data-bs-target="#create_modal_client" data-url="{{route('clients.store')}}">
                                                    <h6>{{translate_title('Add +', $lang)}}</h6>
                                                </a>
                                            </div>
                                            <div class="payment-content-header_user">
                                                <div class="d-flex justify-content-center">
                                                    <div class="position-relative mb-2 width_100_percent">
                                                        <select class="input-default payment-content-header-user_name" name="client_id" data-toggle="select2" data-width="100%" required id="client_select_id_2">
                                                            <option value="" selected disabled>{{translate_title('Select a client', $lang)}}</option>
                                                            <optgroup label="Clients">
                                                                @foreach($clients_for_discount as $client_for_discount)
                                                                    <option value="{{$client_for_discount['client_id']}} {{$client_for_discount['percent']}} /{{$client_for_discount['client_full_name']}} /{{$client_for_discount['phone']}} /{{$client_for_discount['client_all_total_sum']}}">{{$client_for_discount['client_full_name']}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                        <div class="invalid-tooltip">
                                                            {{translate_title('Select a client', $lang)}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between d-none p-1 mb-2" id="clientDiscountContent">
                                                <div>
                                                    <h6 id="clientFullName" class="font_size_12"></h6>
                                                    <div><h6 id="clientPhoneNumber" class="font_size_12"></h6></div>
                                                </div>
                                                <div class="d-flex">
                                                    <a type="button" class="btn delete_button btn-sm waves-effect me-1" id="removeClientDiscount">
                                                        <img src="{{asset('img/trash_icon.png')}}" alt="" height="18px">
                                                    </a>
                                                    <div>
                                                        <h6 id="clientDiscount" class="color_red"></h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="payment-method d-flex justify-content-between mt-3">
                                                <h6 class="payment-method-title d-flex align-items-center">
                                                    <i class="mdi mdi-percent"></i>
                                                    <span class="payment-method-name_">&nbsp;{{translate_title('История покупок', $lang)}}</span>
                                                </h6>
                                                <input class="input-default_ payment-method-sum" placeholder="0 сум" type="text" id="clients_total__sum">
                                            </div>
                                            <div class="payment-method d-flex justify-content-between mt-3">
                                                <h6 class="payment-method-title d-flex align-items-center">
                                                    <i class="mdi mdi-percent"></i>
                                                    <span class="payment-method-name_">&nbsp;{{translate_title('Скидка клиета', $lang)}}</span>
                                                </h6>
                                                <input class="input-default_ payment-method-sum" placeholder="0 сум" type="text" id="clients_discount__sum">
                                            </div>
                                            <div class="payment-method d-flex justify-content-between mt-3 d-none">
                                                <h6 class="payment-method-title d-flex align-items-center">
                                                    <i class="mdi mdi-percent"></i>
                                                    <span class="payment-method-name_">&nbsp;{{translate_title('Обшая скидка', $lang)}}</span>
                                                </h6>
                                                <input class="input-default_ payment-method-sum" placeholder="0 сум" type="text" id="clients_total_discount__sum">
                                            </div>
                                            <div class="payment-method d-flex justify-content-between mt-3 d-none">
                                                <h6 class="payment-method-title d-flex align-items-center">
                                                    <i class="mdi mdi-cash"></i>
                                                    <span class="payment-method-name_">&nbsp;{{translate_title('Итоговая сумма', $lang)}}</span>
                                                </h6>
                                                <input class="input-default_ payment-method-sum" placeholder="0 сум" type="text" id="total__sum">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="fast_selling_goods_modal" role="tabpanel" aria-labelledby="fast_selling_goods_modal-tab">
                                <div class="row">
                                    @foreach($allProductsData['products_fast'] as $product)
                                        <div class="col-4 mt-1 fast_selling_images_button">
                                            <div></div>
                                            <a class="badge-soft-secondary" style="background-image: url('{{$product['image']}}');">
                                                <h6 class="pre_wrap" onclick="addToOrder('{{$product['id']}}', '{{$product['name']}}', '{{$product['price']}}', '{{$product['discount']}}', '{{$product['discount_percent']}}', '{{$product['last_price']}}', '{{$product['amount']}}', '{{$product['barcode']}}', '{{$product['stock']}}', '{{$product['unit']}}', '{{$product['unit_id']}}', 1, null, null)"><b>{{$product['name']}}</b></h6>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="list_aside_the_check" role="tabpanel" aria-labelledby="list_aside_the_check_modal-tab">
                                <div class="right_options" role="presentation">
                                    <div>
                                        <div class="payment-content-header">
                                            <div class="payment-content-header_title mb-3 justify-content-between">
                                                <button class="btn-success btn" data-bs-toggle="modal" data-bs-target="#checklist_modal" id="set_checklist_button">
                                                    <span class="mb-0"><span class="font-16 fa fa-angle-right me-1"></span>{{translate_title('Set aside the check', $lang)}}</span>
                                                </button>
                                                <button class="btn-danger btn" data-bs-toggle="modal" data-bs-target="#checklist_modal_delete" id="set_checklist_button_delete">
                                                    <span class="mb-0"><span class="font-16 fa fa-angle-right me-1"></span>{{translate_title('Delete this check', $lang)}}</span>
                                                </button>
                                            </div>
                                            <div class="payment-content-header_user">
                                                <div class="d-flex justify-content-center">
                                                    <div class="position-relative mb-2 width_100_percent" id="checklist_content">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex add_to_order_buttons_" id="has_items">
                    <div class="d-flex justify-content-between width_100_percent">
{{--                        <a class="modal_close_ delete_button btn me-2" data-bs-toggle="modal" data-bs-target="#delete_modal_cashbox">--}}
{{--                            <b>{{translate_title('Delete', $lang)}}</b>--}}
{{--                        </a>--}}
                        <a class="modal_confirm_pay width_height_confirm_button btn" data-bs-toggle="modal" onclick="paymentFunc()" data-bs-target="#payment_modal">
                            <h4 class="color_white">{{translate_title('Payment', $lang)}}</h4>
                        </a>
                    </div>
                </div>
                <div class="d-flex add_to_order_buttons_" id="no_items">
                    <div class="d-flex justify-content-between width_100_percent">
{{--                        <button class="modal_close_ delete_button btn me-2" data-bs-toggle="modal" data-bs-target="#delete_modal_cashbox" disabled>--}}
{{--                            <b>{{translate_title('Delete', $lang)}}</b>--}}
{{--                        </button>--}}
                        <button class="modal_confirm_pay_ width_height_confirm_button btn" data-bs-toggle="modal" data-bs-target="#payment_modal" disabled>
                            <h4 class="color_white">{{translate_title('Payment', $lang)}}</h4>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="padding_12">
        <table id="all_sum_info" class="tablesaw table mb-0" data-tablesaw-mode="swipe" data-tablesaw-mode-switch data-tablesaw-minimap>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="order_data_content">
                <tr class="d-none">
                    <td>
                        <h4>{{translate_title('Sum:', $lang)}}</h4>
                    </td>
                    <td><h4 id="total_sum" class="text-end"></h4></td>
                </tr>
                <tr class="d-none">
                    <td><b><h4>{{translate_title('Discount', $lang)}}</h4></b></td>
                    <td><h4 id="total_discount" class="text-end"></h4></td>
                </tr>
                <tr>
                    <td><b><h4>{{translate_title('The client must pay:', $lang)}}</h4></b></td>
                    <td>
                        <div class="text-end" id="totalLeftSum">
                            <h4 id="total_left_sum"></h4>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><b><h6 id="order_selected_product_name"></h6></b></td>
                    <td><h6 id="order_selected_product_info" class="text-end"></h6></td>
                </tr>
            </tbody>
        </table>
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
    <div id="checklist_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled">
                <div class="modal-body">
                    <div class="text-center">
                        <img src="{{asset('img/delete_icon.png')}}" alt="" height="100px">
                        <h4 class="mt-2 delete_text_content">{{ translate_title('Are you sure you want to add a checklist?', $lang)}} <b id="this__check_list_code"></b></h4>
                        <div class="d-flex justify-content-between width_100_percent">
                            <a type="button" class="btn delete_modal_close my-2" data-bs-dismiss="modal"> {{ translate_title('No', $lang)}}</a>
                            <a class="btn delete_modal_confirm my-2" data-bs-dismiss="modal" onclick="paymentPayFunc('checklist')"> {{ translate_title('Yes', $lang)}} </a>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="checklist_modal_delete" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled">
                <div class="modal-body">
                    <div class="text-center">
                        <img src="{{asset('img/delete_icon.png')}}" alt="" height="100px">
                        <h4 class="mt-2 delete_text_content">{{ translate_title('Are you sure you want to delete this checklist?', $lang)}} <b id="this_check_list_code"></b></h4>
                        <div class="d-flex justify-content-between width_100_percent">
                            <a type="button" class="btn delete_modal_close my-2" data-bs-dismiss="modal"> {{ translate_title('No', $lang)}}</a>
                            <a class="btn delete_modal_confirm my-2" data-bs-dismiss="modal" onclick="deleteCheckFunc()"> {{ translate_title('Yes', $lang)}} </a>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="create_modal_client"
         aria-labelledby="scrollableModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('Новый клиент', $lang)}}</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <form class="modal-body needs-validation" action="{{route('clients.store', $lang)}}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('POST')
                    <div class="position-relative mb-3">
                        <label for="name" class="form-label">{{translate_title('Name', $lang)}}</label>
                        <input type="text" id="name" class="form-control" name="name" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter name.', $lang)}}
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label for="surname" class="form-label">{{translate_title('Surname', $lang)}}</label>
                        <input type="text" id="surname" class="form-control" name="surname" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter surname.', $lang)}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="middlename" class="form-label">{{translate_title('Middlename', $lang)}}</label>
                        <input type="text" id="middlename" class="form-control" name="middlename">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">{{translate_title('Phone', $lang)}}</label>
                        <input type="text" id="phone" class="form-control" name="phone" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter phone.', $lang)}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image_input" class="form-label">{{translate_title('Image', $lang)}}</label>
                        <div class="d-flex">
                            <div class="default_image_content">
                                <img src="{{asset('img/default_image_plus.png')}}" alt="">
                            </div>
                            <span class="ms-1" id="images_quantity"></span>
                        </div>
                        <input type="file" id="image_input" name="image" class="form-control d-none">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{translate_title('Email', $lang)}}</label>
                        <input type="text" id="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="male">{{translate_title('Male', $lang)}}</label>
                        <input type="radio" name="gender" id="male" value="{{\App\Constants::MALE}}" checked class="me-4">
                        <label for="female">{{translate_title('Female', $lang)}}</label>
                        <input type="radio" name="gender" id="female" value="{{\App\Constants::FEMALE}}">
                    </div>
                    <div class="position-relative mb-3">
                        <label class="form-label">{{translate_title('Region', $lang)}}</label>
                        <select name="region_id" class="form-control" id="region_id" >
                            <option value="" disabled selected>{{translate_title('Select region', $lang)}}</option>
                        </select>
                    </div>
                    <div class="position-relative mb-3">
                        <label class="form-label">{{translate_title('District', $lang)}}</label>
                        <select name="district_id" class="form-control" id="district_id" >
                            <option value="" disabled selected>{{translate_title('Select district', $lang)}}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">{{translate_title('Address', $lang)}}</label>
                        <input type="text" id="address" class="form-control" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">{{translate_title('Notes', $lang)}}</label>
                        <input type="text" id="notes" class="form-control" name="notes">
                    </div>
                    <input type="hidden" name="region" id="region">
                    <input type="hidden" name="district" id="district">
                    <div class="d-flex justify-content-between width_100_percent">
                        <a type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</a>
                        <button type="submit" class="btn modal_confirm">{{translate_title('Create', $lang)}}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="edit_product_modal"
         aria-labelledby="staticBackdropLabel" aria-hidden="true" data-bs-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content width_74_percent">
                <div class="modal-header card-header">
                    <h4 id="selected_product_name"> Milliy cola</h4>
                </div>
                <div class="modal-body card-body">
                    <div class="mt-1">
                        <!-- Sonni ko'rsatish joyi -->
                        <div class="row">
                            <div class="col-5">
                                <h4>{{translate_title('Sum', $lang)}}</h4>
                            </div>
                            <div class="col-7">
                                <input id="selected_product_price" type="number" min="0" class="input-display_password" value="0">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <h4>{{translate_title('Amount', $lang)}}</h4>
                            </div>
                            <div class="col-4">
                                <input id="selected_product_amount" type="number" max="1000" min="0" class="input-display_password" value="0">
                            </div>
                            <div class="col-3">
                                <h6 id="selected_product_unit"></h6>
                            </div>
                        </div>
                        <div class="mb-2">
                            <!-- Raqamlar tugmalari -->
                            <div class="row mb-2">
                                <div class="col-4">
                                    <a class="btn btn-outline-dark btn-number-password" onclick="appendEditProduct(1)">1</a>
                                </div>
                                <div class="col-4">
                                    <a class="btn btn-outline-dark btn-number-password" onclick="appendEditProduct(2)">2</a>
                                </div>
                                <div class="col-4">
                                    <a class="btn btn-outline-dark btn-number-password" onclick="appendEditProduct(3)">3</a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="row mb-2">
                                <div class="col-4">
                                    <a class="btn btn-outline-dark btn-number-password" onclick="appendEditProduct(4)">4</a>
                                </div>
                                <div class="col-4">
                                    <a class="btn btn-outline-dark btn-number-password" onclick="appendEditProduct(5)">5</a>
                                </div>
                                <div class="col-4">
                                    <a class="btn btn-outline-dark btn-number-password" onclick="appendEditProduct(6)">6</a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="row">
                                <div class="col-4">
                                    <a class="btn btn-outline-dark btn-number-password" onclick="appendEditProduct(7)">7</a>
                                </div>
                                <div class="col-4">
                                    <a class="btn btn-outline-dark btn-number-password" onclick="appendEditProduct(8)">8</a>
                                </div>
                                <div class="col-4">
                                    <a class="btn btn-outline-dark btn-number-password" onclick="appendEditProduct(9)">9</a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="row mb-2">
                                <div class="col-4 mt-2">
                                    <a class="btn btn-outline-dark btn-number-password" onclick="appendEditProduct(0)">0</a>
                                </div>
                                <div class="col-4 mt-2 d-none" id="dotKeyboard">
                                    <a class="btn btn-outline-dark btn-number-password" onclick="appendDotEditProduct()">.</a>
                                </div>
                                <div class="col-4 mt-2">
                                    <a class="btn btn-outline-dark btn-number-password" onclick="backspaceEditProduct()">
                                        <span class="mdi mdi-backspace"></span>
                                    </a>
                                </div>
                                <div class="col-4 mt-2">
                                    <a class="btn btn-outline-dark btn-number-password" onclick="clearDisplayEditProduct()">Clear</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between width_100_percent mt-4">
                        <a class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</a>
                        <button type="submit" class="btn modal_confirm" onclick="changeAmountAndPrice()" data-bs-dismiss="modal">{{translate_title('Confirm', $lang)}}</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <input type="hidden" id="barcode_input">
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
        let cashbox_index = "{{route('indexLarge', $lang)}}"
        let token = "{{$user->token}}"
        let json_products = JSON.parse('{!! $allProductsData['json_products'] !!}')
        let notify_text = "{{translate_title('amount was added successfully!', $lang)}}"
        let notify_text_left_in_stock = "{{translate_title('left in stock', $lang)}}"
        let payment_success_text = "{{translate_title('The payment was made successfully', $lang)}}"
        let set_aside_success_text = "{{translate_title('The check successfull set aside', $lang)}}"
        let client_total_sales = 0
        let clientPhoneNumber = document.getElementById('clientPhoneNumber')
        let selected_checklist_id = ''
        let checklist_changed = false
        let checklist_items = document.getElementsByName('checklist_item')
        let checklist_content = document.getElementById('checklist_content')
        let this_check_list_code = document.getElementById('this_check_list_code')
        let this__check_list_code = document.getElementById('this__check_list_code')
        let check_code = document.getElementById('check_code')
        let all_checklist_sales = `{!! $all_checklist_sales !!}`

        let set_checklist_button_delete = document.getElementById('set_checklist_button_delete')
        if(set_checklist_button_delete != undefined && set_checklist_button_delete != null) {
            set_checklist_button_delete.disabled = true
        }

        $('#client_select_id_2').on('change', function () {
            let discountInfo = client_select_id_2.value.split(" ")
            let discountClientInfo = client_select_id_2.value.split("/")
            if(discountInfo[1] != undefined && discountInfo[1] != null){
                discountValue = discountInfo[1]
                client_id = discountInfo[0]
            }
            if(parseInt(discountValue) != 0){
                percent_v = (100 - discountValue)/100
            }
            if(discountClientInfo[1] != undefined && discountClientInfo[1] != null){
                clientFullName.innerText = ' '+discountClientInfo[1]
            }
            if(discountClientInfo[2] != undefined && discountClientInfo[2] != null){
                clientPhoneNumber.innerText = ' '+discountClientInfo[2]
            }
            if(discountClientInfo[3] != undefined && discountClientInfo[3] != null){
                client_total_sales = discountClientInfo[3]
            }
            confirm_client_discount_func(discountValue)
            setClientPrices()
        })
        let checklistData = []

        let check_lists_data_html = ''

        function check_list_set_html(data){
            check_lists_data_html = ''
            for(let i=0; i<data.length; i++){
                check_lists_data_html = check_lists_data_html + `<div class='checklist_item' onclick='checklistFunc(${JSON.stringify(data[i]['sale_items'])}, ${data[i]['id']}, "${data[i]['code']}", this)'>
                            <h6>${data[i]['code']}</h6>
                            <h6>${data[i]['price']}</h6>
                        </div>`
            }
            checklist_content.innerHTML = check_lists_data_html
        }
        function getCheckAsideFunc(){
            $(document).ready(function () {
                $.ajax({
                    url:`/../api/get-check-aside`,
                    type:'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    success: function (data) {
                        console.log(data)
                        check_list_set_html(data)
                    },
                    error: function (e) {
                        console.log(e)
                    }
                })
            })
        }
        getCheckAsideFunc()
        let old_selected_checklist_id = ''
        let selected_checklist_is_active = false
        function checklistFunc(checklist_data, checklist_id, checklist_code, selected_checklist){
            let checklist_items_ = document.getElementsByClassName('checklist_item')
            truncuateCashboxFunc()
            for(let k=0; k<checklist_items_.length; k++){
                if(checklist_items_[k].classList.contains('active')){
                    checklist_items_[k].classList.remove('active')
                }
            }
            if(selected_checklist != null && selected_checklist != undefined){
                if(checklist_id != '' && old_selected_checklist_id == checklist_id && !selected_checklist_is_active){
                    selected_checklist.classList.remove('active')
                    if(check_code.classList.contains('d-none')){
                        check_code.classList.add('d-none')
                    }
                    set_checklist_button_delete.disabled = true
                    if(selected_checklist_is_active){
                        selected_checklist_is_active = false
                    }else{
                        selected_checklist_is_active = true
                    }
                    checklist_changed = false
                    selected_checklist_id = ''
                }else{
                    selected_checklist_is_active = false
                    old_selected_checklist_id = checklist_id
                    if(!selected_checklist.classList.contains('active')){
                        selected_checklist.classList.add('active')
                        checklistData = JSON.parse(checklist_data)
                        for(let i=0; i<checklistData.length; i++){
                            addToOrder(checklistData[i].id, checklistData[i].name, checklistData[i].price, checklistData[i].discount, checklistData[i].discount_percent, checklistData[i].last_price, checklistData[i].amount, checklistData[i].barcode, checklistData[i].stock, checklistData[i].unit, checklistData[i].unit_id, checklistData[i].quantity, checklist_code, null)
                        }
                        this_check_list_code.innerText = checklist_code
                        this__check_list_code.innerText = checklist_code
                        if(set_checklist_button_delete != undefined && set_checklist_button_delete != null) {
                            set_checklist_button_delete.disabled = false
                        }
                        if(!check_code.classList.contains('d-none')){
                            check_code.classList.remove('d-none')
                        }
                        checklist_changed = true
                        set_checklist_button_delete.disabled = false
                        selected_checklist_id = checklist_id

                    }
                }
            }
        }

    </script>
    <script src="{{asset('js/products_keyboards.js')}}"></script>
    {{--    <script src="{{asset('js/cities.js')}}"></script>--}}
    <script src="{{asset('js/large_ordering.js')}}"></script>
    <script>
        let barcodeInput = document.getElementById('barcode_input')
        barcodeInput.focus()
        let scannedBarcode = ''

        document.addEventListener('keydown', function(event) {
            setTimeout(function () {
                if (event.key === 'Enter') {
                    console.log("Barcode Scanned:", scannedBarcode);
                    handleBarcode(scannedBarcode);
                    scannedBarcode = '';
                } else {
                    scannedBarcode += event.key;
                }
            }, 244);
        });

        function handleBarcode(barcode) {
            for(let p=0; p<json_products.length; p++){
                if(json_products[p].barcode == barcode){
                    addToOrder(json_products[p].id, json_products[p].name, json_products[p].price, json_products[p].discount, json_products[p].discount_percent, json_products[p].last_price, json_products[p].amount, json_products[p].barcode, json_products[p].stock, json_products[p].unit, json_products[p].unit_id, 1, null, null)
                }
            }
        }

    </script>
    <script>
        let page = false
        let current_region = ''
        let current_district = ''
        if(localStorage.getItem('region_id') != undefined && localStorage.getItem('region_id') != null){
            localStorage.removeItem('region_id')
        }
        if(localStorage.getItem('district_id') != undefined && localStorage.getItem('district_id') != null){
            localStorage.removeItem('district_id')
        }
        if(localStorage.getItem('region') != undefined && localStorage.getItem('region') != null){
            localStorage.removeItem('region')
        }
        if(localStorage.getItem('district') != undefined && localStorage.getItem('district') != null){
            localStorage.removeItem('district')
        }

        let sessionSuccess ="{{session('status')}}";
        if(sessionSuccess){
            toastr.success(sessionSuccess)
        }
        let sessionError ="{{session('error')}}";
        if(sessionError){
            toastr.warning(sessionError)
        }
    </script>

    <script src="{{asset('js/cities.js')}}"></script>
@endsection

