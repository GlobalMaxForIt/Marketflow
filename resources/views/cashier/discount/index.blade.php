@extends('layouts.cashier_layout')

@section('title')
    {{translate_title('Discount', $lang)}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item ms-2">
                    <a href="#discount" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                        {{translate_title("Discount", $lang)}}
                        @if(!empty($users))
                            <span class="badge bg-danger_">{{count($users)}}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item ms-2">
                    <a href="#discount_client" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        {{translate_title("Clients' discount", $lang)}}
                        @if(!empty($stuffs_categories))
                            <span class="badge bg-danger_">{{count($stuffs_categories)}}</span>
                        @endif
                    </a>
                </li>
            </ul>

            <div class="card-body">
                <div class="tab-content" id="discount_tab">
                    <div class="tab-pane fade show active" id="discount" role="tabpanel" aria-labelledby="discount-tab">
                        <div class="card">
                            <div class="right_button_create">
                                <button class="form_functions global-button" data-bs-toggle="modal" data-bs-target="#create_modal" data-url="{{route('cashier-discount.store')}}">
                                    <img src="{{asset('menubar/discount_active.png')}}" alt="" height="20px">
                                    {{translate_title('Новый Скидка', $lang)}}
                                </button>
                            </div>

                            <div class="card-body">
                                <table class="datatable restaurant_tables table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><h6>{{translate_title('Discount percent', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Category', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Product', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Number of products', $lang)}}</h6></th>
                                            <th class="text-center">{{translate_title('Functions', $lang)}}</h6></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table_body">
                                    @php
                                        $i = 0
                                    @endphp
                                    @foreach($discounts_data as $discount_data)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td>
                                                <span>
                                                    {{$i}}
                                                </span>
                                            </td>
                                            <td>
                                                <span>
                                                    @if($discount_data['discount'][0]->percent != null)
                                                        {{$discount_data['discount'][0]->percent.' %'}}
                                                    @else
                                                        <div class="no_text"></div>
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <span>
                                                    @if(!empty($discount_data['category'][0]) || !empty($discount_data['subcategory'][0]))
                                                        {{implode(', ', [$discount_data['category'][0], $discount_data['subcategory'][0]])}}
                                                    @else
                                                        <div class="no_text"></div>
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <span>
                                                    @if(count($discount_data['discount']) == 1)
                                                        {{$discount_data['discount'][0]->product->name}}
                                                    @elseif(count($discount_data['discount']) > 1)
                                                        {{translate_title('All products', $lang)}}
                                                    @else
                                                        <div class="no_text"></div>
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <span>
                                                    @if(isset($discount_data['number']))
                                                        {{$discount_data['number']}}
                                                    @else
                                                        <div class="no_text"></div>
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="function_column">
                                                <div class="d-flex justify-content-around align-items-center height_50 function_buttons">
                                                    <a class="edit_button btn" href="{{route('cashier-discount.edit', $discount_data['discount'][0]->id)}}">
                                                        <img src="{{asset('img/edit_icon.png')}}" alt="" height="18px">
                                                    </a>
                                                    <button type="button" class="btn delete_button btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('cashier-discount.destroy', $discount_data['discount'][0]->id)}}">
                                                        <img src="{{asset('img/trash_icon.png')}}" alt="" height="18px">
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="discount_client" role="tabpanel" aria-labelledby="discount_client-tab">
                        <div class="card">
                            <div class="right_button_create">
                                <button class="form_functions global-button" data-bs-toggle="modal" data-bs-target="#create_discount_client_modal" data-url="{{route('cashier-discount.store')}}">
                                    <img src="{{asset('menubar/discount_active.png')}}" alt="" height="20px">
                                    {{translate_title('Новый Скидка', $lang)}}
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table datatable restaurant_tables table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><h6>{{translate_title('Discount percent', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Client', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Discount number', $lang)}}</h6></th>
                                            <th class="text-center">{{translate_title('Functions', $lang)}}</h6></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table_body">
                                    @php
                                        $i = 0
                                    @endphp
                                    @foreach($discounts_client_data as $discount_client_data)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td>
                                                <span>
                                                    {{$i}}
                                                </span>
                                            </td>
                                            <td>
                                                <span>
                                                    @if($discount_client_data['percent'] != null)
                                                        {{$discount_client_data['percent'].' %'}}
                                                    @else
                                                        <div class="no_text"></div>
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <span>
                                                    @if($discount_client_data['client_full_name'])
                                                        {{$discount_client_data['client_full_name']}}
                                                    @else
                                                        <div class="no_text"></div>
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <span>
                                                    @if($discount_client_data['discount_number'])
                                                        {{$discount_client_data['discount_number']}}
                                                    @else
                                                        <div class="no_text"></div>
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="function_column">
                                                <div class="d-flex justify-content-around align-items-center height_50 function_buttons">
                                                    <a class="edit_button btn" href="{{route('cashier-discount.edit', $discount_client_data['id'])}}">
                                                        <img src="{{asset('img/edit_icon.png')}}" alt="" height="18px">
                                                    </a>
                                                    <button type="button" class="btn delete_button btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('cashier-discount.destroy', $discount_client_data['id'])}}">
                                                        <img src="{{asset('img/trash_icon.png')}}" alt="" height="18px">
                                                    </button>
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
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="create_modal"
         aria-labelledby="scrollableModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('New discount', $lang)}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('cashier-discount.store')}}" class="modal-body needs-validation" method="POST" novalidate>
                    @csrf
                    @method("POST")

                    <div class="position-relative mb-3">
                        <label class="form-label">{{translate_title('Discount percent', $lang)}}</label>
                        <input data-toggle="touchspin" type="number" name="percent" min="0" max="100" data-bts-postfix="%" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter percent.', $lang)}}
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <select class="form-select" name="products_categories_id" id="category_id" aria-label="Floating label select example" required>
                            <option value="" selected disabled>{{translate_title('Select category', $lang)}}</option>
                            <option value="all">{{translate_title('All subcategory', $lang)}}</option>
                            @foreach($products_categories as $products_category)
                                <option value="{{$products_category->id}}">{{$products_category->name}} {{$products_category->category?$products_category->category->name:''}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Please select category.', $lang)}}
                        </div>
                        <label class="form-label" for="category_id">{{translate_title('Products categories', $lang)}}</label>
                    </div>
                    <div class="position-relative mb-3 d-none" id="subcategory_exists">
                        <div class="form-floating">
                            <select class="form-select" name="products_sub_categories_id" id="subcategory_id" aria-label="Floating label select example">

                            </select>
                            <label for="subcategory_id">{{translate_title('Products sub categories', $lang)}}</label>
                        </div>
                    </div>
                    <div class="position-relative mb-3 d-none" id="product_exists">
                        <div class="form-floating">
                            <select class="form-select" name="product_id" id="product_id" aria-label="Floating label select example">

                            </select>
                            <label for="subcategory_id">{{translate_title('Products', $lang)}}</label>
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label class="form-label">{{translate_title('Range date', $lang)}}</label>
                        <input type="text" name="start_end_date" class="form-control range-datepicker" value="{{old('start_end_date')}}" placeholder="2018-10-03 to 2018-10-10" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter range date.', $lang)}}
                        </div>
                    </div>
                    <div class="width_100_percent d-flex justify-content-between mt-5">
                        <button type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</button>
                        <button type="submit" class="btn modal_confirm">{{translate_title('Create', $lang)}}</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    <div class="modal fade" tabindex="-1" role="dialog" id="create_discount_client_modal"
         aria-labelledby="scrollableModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('New clients\' discount', $lang)}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('cashier-discount.store')}}" class="modal-body needs-validation" method="POST" novalidate>
                    @csrf
                    @method("POST")
                    <div class="position-relative mb-3">
                        <label class="form-label">{{translate_title('Discount percent', $lang)}}</label>
                        <input data-toggle="touchspin" type="number" name="percent" min="0" max="100" data-bts-postfix="%" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter percent.', $lang)}}
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <select class="form-control" name="client_id" data-toggle="select2" data-width="100%" required id="client_select_id">
                            <option value="" selected disabled>{{translate_title('Select a client', $lang)}}</option>
                            <optgroup label="Clients">
                                @foreach($clients_for_discount as $client_for_discount)
                                    <option value="{{$client_for_discount['id']}}">{{$client_for_discount['name'].' '.$client_for_discount['surname']}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Select a client', $lang)}}
                        </div>
                        <label class="form-label" for="client_select_id">{{translate_title('Clients', $lang)}}</label>
                    </div>
                    <div class="position-relative mb-3">
                        <label class="form-label">{{translate_title('Range date', $lang)}}</label>
                        <input type="text" name="start_end_date" class="form-control range-datepicker" value="{{old('start_end_date')}}" placeholder="2018-10-03 to 2018-10-10" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter range date.', $lang)}}
                        </div>
                    </div>
                    <div class="width_100_percent d-flex justify-content-between mt-5">
                        <button type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</button>
                        <button type="submit" class="btn modal_confirm">{{translate_title('Create', $lang)}}</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    <script>
        let discount_category_id = ""
        let discount_subcategory_id = ""
        let discount_product_id = ""
        let discount_warehouse_id = ""
        let discount_percent_value = ""

        let client_discount_category_id = ""
        let client_discount_subcategory_id = ""
        let client_discount_product_id = ""
        let client_discount_warehouse_id = ""
        let client_discount_percent_value = ""

        let text_select_sub_category = "{{translate_title('Select sub category', $lang)}}"
        let text_all_subcategory_products = "{{translate_title('All subcategories`s products', $lang)}}"
        let text_all_products = "{{translate_title('All products', $lang)}}"
        let text_select_product = "{{translate_title('Select product', $lang)}}"

        $(document).ready(function () {
            if($('#client_select_id') != undefined && $('#client_select_id') != null){
                $('#client_select_id').select2({
                    dropdownParent: $('#create_discount_client_modal') // modal ID ni kiriting
                });
            }
        })
    </script>

    <script src="{{asset('js/discount.js')}}"></script>
@endsection
