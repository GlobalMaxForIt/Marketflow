@extends('layouts.superadmin_layout')

@section('title')
   {{translate_title('Edit discount', $lang)}}
@endsection
@section('content')
    <div class="mt-5">
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
            <div class="card">
                <div class="tab-content card-body" id="discount_tab">
                    <div class="tab-pane fade show active" id="discount" role="tabpanel" aria-labelledby="discount-tab">
                        <p class="text-muted font-14">
                            {{translate_title('Edit discount', $lang)}}
                        </p>
                        <form action="{{route('discount.update', $discount->id)}}" class="parsley-examples needs-validation modal-body" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method("PUT")
                            <div class="row">
                                <div class="position-relative d-flex flex-column mb-3 col-3">
                                    <label class="form-label">{{translate_title('Discount percent', $lang)}}</label>
                                    <input data-toggle="touchspin" type="number" name="percent" value="{{$discount->percent}}" min="0" max="100" data-bts-postfix="%" required>
                                    <div class="invalid-tooltip">
                                        {{translate_title('Please enter percent.', $lang)}}
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="position-relative mb-3 col-3">
                                    <label class="form-label">{{translate_title('Range date', $lang)}}</label>
                                    <input type="text" name="start_end_date" class="form-control range-datepicker" value="{{$start_end_date}}" placeholder="2018-10-03 to 2018-10-10" required>
                                    <div class="invalid-tooltip">
                                        {{translate_title('Please select range dates.', $lang)}}
                                    </div>
                                </div>
                                <div class="position-relative mb-3 col-6">
                                    <div class="form-floating">
                                        <select name="products_categories_id" class="form-control" id="category_id" required>
                                            <option value="all" selected>{{translate_title('All category', $lang)}}</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{$category->id == $category_id? 'selected' : ''}}>{{$category->name}} {{$category->category?$category->category->name:''}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-tooltip">
                                            {{translate_title('Please select category.', $lang)}}
                                        </div>
                                        <label class="form-label">{{translate_title('Category', $lang)}}</label>
                                    </div>
                                </div>

                                <div class="position-relative mb-3 col-6 d-none" id="subcategory_exists">
                                    <div class="form-floating">
                                        <select class="form-select" name="products_sub_categories_id" id="subcategory_id" aria-label="Floating label select example">

                                        </select>
                                        <label for="subcategory_id">{{translate_title('Products sub categories', $lang)}}</label>
                                    </div>
                                </div>

                                <div class="position-relative mb-3 col-6 d-none" id="product_exists">
                                    <div class="form-floating">
                                        <select class="form-select" name="product_id" id="product_id" aria-label="Floating label select example">

                                        </select>
                                        <label for="product_id">{{translate_title('Products', $lang)}}</label>
                                    </div>
                                </div>
                                <div class="col-6 d-flex justify-content-end width_100_percent">
                                    <button type="submit" class="btn modal_confirm">{{translate_title('Update', $lang)}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="discount_client" role="tabpanel" aria-labelledby="discount_client-tab">
                        <p class="text-muted font-14">
                            {{translate_title('Edit clients\' discount', $lang)}}
                        </p>
                        <form action="{{route('discount.update', $discount->id)}}" class="parsley-examples needs-validation modal-body" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method("PUT")
                            @csrf
                            @method("POST")
                            <div class="row">
                                <div class="position-relative mb-3 d-flex flex-column col-3">
                                    <label class="form-label">{{translate_title('Discount percent', $lang)}}</label>
                                    <input data-toggle="touchspin" type="number" name="percent"  value="{{$discount->percent}}" min="0" max="100" data-bts-postfix="%" required>
                                    <div class="invalid-tooltip">
                                        {{translate_title('Please enter percent.', $lang)}}
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="position-relative mb-3 col-3">
                                    <label class="form-label">{{translate_title('Range date', $lang)}}</label>
                                    <input type="text" name="start_end_date" class="form-control range-datepicker"  value="{{$start_end_date}}" placeholder="2018-10-03 to 2018-10-10" required>
                                    <div class="invalid-tooltip">
                                        {{translate_title('Please enter range date.', $lang)}}
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="position-relative mb-3 col-3">
                                    <label class="form-label">{{translate_title('Select client', $lang)}}</label>
                                    <div class="form-floating">
                                        <select class="form-control" name="client_id" data-toggle="select2" data-width="100%" required id="client_select_id">
                                            <option value="" selected disabled>{{translate_title('Select a client', $lang)}}</option>
                                            <optgroup label="Clients">
                                                @foreach($clients_for_discount as $client_for_discount)
                                                    <option value="{{$client_for_discount['id']}}" {{$discount->client_id == $client_for_discount['id']?'selected':''}}>{{$client_for_discount['name']}}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                        <div class="invalid-tooltip">
                                            {{translate_title('Please select client.', $lang)}}
                                        </div>
                                    </div>
                                </div>
                                <div class="width_100_percent d-flex justify-content-between mt-5 col-6">
                                    <button type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</button>
                                    <button type="submit" class="btn modal_confirm">{{translate_title('Create', $lang)}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let discount_category_id = "{{$category_id}}"
        let discount_subcategory_id = "{{$subcategory_id}}"
        @if($quantity == 1)
            let discount_product_id = "{{$discount->product_id}}"
        @elseif($quantity > 1)
            let discount_product_id = "two"
        @else
            let discount_product_id = ""
        @endif
        let discount_percent_value = "{{$discount->percent??''}}"
        let text_select_sub_category = "{{translate_title('Select sub category', $lang)}}"
        let text_all_subcategory_products = "{{translate_title('All subcategories`s products', $lang)}}"
        let text_all_products = "{{translate_title('All products', $lang)}}"
        let text_select_product = "{{translate_title('Select product', $lang)}}"

        $(document).ready(function () {
            if($('#client_select_id') != undefined && $('#client_select_id') != null){
                $('#client_select_id').select2({
                    dropdownParent: $('#discount_client') // modal ID ni kiriting
                });
            }
        })
    </script>
    <script src="{{asset('js/discount.js')}}"></script>
@endsection
