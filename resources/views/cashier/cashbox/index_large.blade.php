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
        <div class="col-9">
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
                                            data-tablesaw-priority="3"><h6><b>{{translate_title('Quantity', $lang)}}</b></h6>
                                        </th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1"><h6><b>{{translate_title('Sum', $lang)}}</b></h6></th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4"><h6><b>{{translate_title('Functions', $lang)}}</b></h6></th>
                                    </tr>
                                </thead>

                                <tbody id="order_data_content">

                                </tbody>
                            </table>


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
                                        <td><b><h4>{{translate_title('Sum', $lang)}}</h4></b></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><b><h4>{{translate_title('Discount', $lang)}}</h4></b></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><b><h4>{{translate_title('Total sum', $lang)}}</h4></b></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 ps-2">
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
            let keys = document.querySelectorAll('.key_big');
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
        }, 544)

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

@endsection

