@extends('layouts.cashier_small_layout')

@section('title')
    {{translate_title('Checkout', $lang)}}
@endsection
@section('content')
    <style>
        .select2-container {
            z-index: 1055 !important; /* Bootstrap modal uchun z-indexdan yuqori qiymat */
        }
        .key h6, .key_space h6{
            margin: 0px !important;
        }
        #popover-container td{
            padding: 4px 0px !important;
            height: 40px !important;
        }
    </style>
    <div class="row">
        <div class="col-7">
            <div class="main-content-section" id="myDiv">
                <div class="order-section">
                    <div class="card">
                        <div class="card-body overflow-auto">

                            <table class="restaurant_tables datatable table table-striped nowrap">
                                <thead>
                                    <tr>
                                        <th><h6><b>{{translate_title('Barcode', $lang)}}</b></h6></th>
                                        <th><h6><b>{{translate_title('Name', $lang)}}</b></h6></th>
                                        <th><h6><b>{{translate_title('Price', $lang)}}</b></h6></th>
                                        <th><h6><b>{{translate_title('Stock', $lang)}}</b></h6></th>
                                        <th><h6><b>{{translate_title('Functions', $lang)}}</b></h6></th>
                                    </tr>
                                </thead>
                                <tbody id="popover-container">
                                @foreach($allProductsData['products'] as $product)
                                    <tr>
                                        <td class="market_tables_text">
                                            <span><h6><b>{{$product['barcode']}}</b></h6></span>
                                        </td>
                                        <td class="market_tables_text">
                                            <span>
                                                <h6>
                                                    <a class="product_name" data-bs-container="#popover-container" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="{{$product['name']}}" data-original-title="">{{$product['short_name']}}</a>
                                                </h6>
                                            </span>
                                            <span><h6><b>{{$product['amount']}}</b></h6></span>
                                        </td>
                                        <td class="market_tables_text">
                                            <div><span><h6><b>{{$product['last_price']}}</b></h6></span></div>
                                            @if($product['discount']>0)
                                                <del><h6><b>{{$product['price']}}</b></h6></del>
                                            @endif
                                        </td>
                                        <td class="market_tables_text">
                                            <h6><b class="stock__quantity" id="stock__{{$product['id']}}">{{$product['stock']}}</b></h6>
                                        </td>
                                        <td class="market_tables_text">
                                            <button class="edit_button btn" onclick="addToOrder('{{$product['id']}}', '{{$product['name']}}', '{{$product['price']}}', '{{$product['discount']}}', '{{$product['discount_percent']}}', '{{$product['last_price']}}', '{{$product['amount']}}', '{{$product['barcode']}}', this)">+</button>
                                            <button class="ms-2 edit_button btn" onclick="minusProduct('{{$product['id']}}', this)">-</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5 ps-2">
            <div class="d-flex justify-content-between mb-2">
                <button class="edit_button btn me-2" data-bs-toggle="modal" data-bs-target="#client_with_discount" id="client_with_discount_button">
                    <b>{{translate_title('Select client with discount', $lang)}}</b>
                </button>
            </div>
            <div class="main-content-section">
                <div class="right_options" role="presentation">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><h6><b>{{translate_title('Barcode', $lang)}}</b></h6></th>
                                <th><h6><b>{{translate_title('Product name', $lang)}}</b></h6></th>
                                <th><h6><b>{{translate_title('Qty', $lang)}}</b></h6></th>
                                <th><h6><b>{{translate_title('Price', $lang)}}</b></h6></th>
                                <th><h6><b>{{translate_title('Total sum', $lang)}}</b></h6></th>
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
        let kitchen_index = "{{route('cashbox.index', $lang)}}"
        let json_products = JSON.parse('{!! $allProductsData['json_products'] !!}')
        let page = false
        let input__event = {}
        $(document).ready(function () {
            if($('#client_select_id_2') != undefined && $('#client_select_id_2') != null){
                $('#client_select_id_2').select2({
                    dropdownParent: $('#client_with_discount'), // Modal ID
                    width: '100%' // Select2 dropdownni kengligini moslashtiradi
                });
            }
        })
        setTimeout(function () {
            let dataTables_filter_input = document.querySelector('.dataTables_filter input')
            let keys = document.querySelectorAll('.key');
            keys.forEach(key => {
                key.addEventListener('click', () => {
                    const keyText = key.textContent.trim();
                    if (keyText === 'Space') {
                        dataTables_filter_input.value += ' ';
                    } else {
                        dataTables_filter_input.value += keyText;
                    }

                    inputEvent(dataTables_filter_input)
                });
            });
        }, 844)

        function clearKeyboardDisplay(){
            let dataTables_filter_input = document.querySelector('.dataTables_filter input')
            dataTables_filter_input.value = ''
            inputEvent(dataTables_filter_input)
        }
        function backspaceKeyboard(){
            let dataTables_filter_input = document.querySelector('.dataTables_filter input')
            if (dataTables_filter_input.value.length > 1) {
                dataTables_filter_input.value = String(dataTables_filter_input.value).slice(0, -1)
            } else {
                dataTables_filter_input.value = ''
            }
            inputEvent(dataTables_filter_input)
        }
       function inputEvent(dataTables_filter_input){
           // "input" hodisasini qo'lda qo'zg'atish
            input__event = new Event('input', { bubbles: true });
            dataTables_filter_input.dispatchEvent(input__event);
        }
    </script>

    {{--    <script src="{{asset('js/cities.js')}}"></script>--}}
    <script src="{{asset('js/small_ordering.js')}}"></script>
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
                    addToOrder(json_products[p].id, json_products[p].name, json_products[p].price, json_products[p].discount, json_products[p].discount_percent, json_products[p].last_price, json_products[p].amount, json_products[p].barcode, current_element_stock)
                }
            }
        }

    </script>

@endsection

