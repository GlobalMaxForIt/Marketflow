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
        <div class="main-content-section" id="myDiv">
            <div class="order-section">
                <div class="card">
                    <div class="card-body overflow-auto">
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
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4"><h6><b>{{translate_title('Functions', $lang)}}</b></h6></th>
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
                                                            <option value="{{$client_for_discount['client_id']}} {{$client_for_discount['percent']}} /{{$client_for_discount['client_full_name']}} /{{$client_for_discount['phone']}}">{{$client_for_discount['client_full_name']}}</option>
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
                                        <div class="d-flex justify-content-start mt-4">
                                                <span class="payment-content-header-title_name">
                                                    <h6>{{translate_title('Способ  оплаты', $lang)}}</h6>
                                                </span>
                                        </div>
                                        <div class="payment-method d-flex justify-content-between mt-3">
                                            <h6 class="payment-method-title d-flex align-items-center">
                                                <i class="mdi mdi-percent"></i>
                                                <span class="payment-method-name_">&nbsp;{{translate_title('Скидка клиета', $lang)}}</span>
                                            </h6>
                                            <input class="input-default_ payment-method-sum" placeholder="0 сум" type="text" id="clients_discount__sum">
                                        </div>
                                        <div class="payment-method d-flex justify-content-between mt-3">
                                            <h6 class="payment-method-title d-flex align-items-center">
                                                <i class="mdi mdi-percent"></i>
                                                <span class="payment-method-name_">&nbsp;{{translate_title('Обшая скидка', $lang)}}</span>
                                            </h6>
                                            <input class="input-default_ payment-method-sum" placeholder="0 сум" type="text" id="clients_total_discount__sum">
                                        </div>
                                        <div class="payment-method d-flex justify-content-between mt-3">
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
                                <div class="col-4">
                                    <a class="badge badge-soft-secondary" onclick="addToOrder('{{$product['id']}}', '{{$product['name']}}', '{{$product['price']}}', '{{$product['discount']}}', '{{$product['discount_percent']}}', '{{$product['last_price']}}', '{{$product['amount']}}', '{{$product['barcode']}}', '{{$product['stock']}}')">
                                        <h6>{{$product['name']}}</h6>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex add_to_order_buttons_" id="has_items">
                <div class="d-flex justify-content-between">
                    <a class="modal_close_ delete_button btn me-2" data-bs-toggle="modal" data-bs-target="#delete_modal_cashbox">
                        <b>{{translate_title('Delete', $lang)}}</b>
                    </a>
                    <a class="modal_confirm_ btn" onclick="paymentFunc()" data-bs-toggle="modal" data-bs-target="#payment_modal">
                        <b>{{translate_title('Payment', $lang)}}</b>
                    </a>
                </div>
            </div>
            <div class="d-flex add_to_order_buttons_" id="no_items">
                <div class="d-flex justify-content-between">
                    <button class="modal_close_ delete_button btn me-2" data-bs-toggle="modal" data-bs-target="#delete_modal_cashbox" disabled>
                        <b>{{translate_title('Delete', $lang)}}</b>
                    </button>
                    <button class="modal_confirm_ btn" data-bs-toggle="modal" data-bs-target="#payment_modal" disabled>
                        <b>{{translate_title('Payment', $lang)}}</b>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="padding_12">
    <table id="all_sum_info" class="tablesaw table mb-0" data-tablesaw-mode="swipe" data-tablesaw-mode-switch
           data-tablesaw-minimap>
        <thead>
        <tr>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody id="order_data_content">
        <tr>
            <td>
                <h4>{{translate_title('Sum:', $lang)}}</h4>
            </td>
            <td><h4 id="total_sum" class="text-end"></h4></td>
        </tr>
        <tr>
            <td><b><h4>{{translate_title('Discount', $lang)}}</h4></b></td>
            <td><h4 id="total_discount" class="text-end"></h4></td>
        </tr>
        <tr>
            <td><b><h4>{{translate_title('Total left sum:', $lang)}}</h4></b></td>
            <td>
                <div class="text-end" id="totalLeftSum">
                    <h4 id="total_left_sum"></h4>
                </div>
            </td>
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
                let current_element_stock = document.getElementById('stock__'+json_products[p].id)
                addToOrder(json_products[p].id, json_products[p].name, json_products[p].price, json_products[p].discount, json_products[p].discount_percent, json_products[p].last_price, json_products[p].amount, json_products[p].barcode, json_products[p].stock, current_element_stock)
            }
        }
    }

</script>
<script>
    let clientPhoneNumber = document.getElementById('clientPhoneNumber')
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
        confirm_client_discount_func(discountValue)
        setClientPrices()
    })

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

