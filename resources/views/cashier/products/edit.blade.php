@extends('layouts.cashier_layout')

@section('title')
    {{translate_title('Edit product', $lang)}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt-0 header-title">{{translate_title('Edit product', $lang)}}</h4>
                </div>
                <div class="card-body">
                    <form class="modal-body needs-validation" action="{{route('cashier-product.update', $product->id)}}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="position-relative col-6">
                                <div class="form-floating">
                                    <select class="form-select" name="products_categories_id" id="category_id" aria-label="Floating label select example" required>
                                        <option value="" selected disabled>{{translate_title('Select category', $lang)}}</option>
                                        @foreach($products_categories as $products_category)
                                            <option value="{{$products_category->id}}"
                                                @if($current_category != 'no')
                                                    {{$current_category->id == $products_category->id?'selected':''}}
                                                @endif>
                                                {{$products_category->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-tooltip">
                                        {{translate_title('Please select category.', $lang)}}
                                    </div>
                                    <label for="floatingSelect">{{translate_title('Products categories', $lang)}}</label>
                                </div>
                            </div>
                            <div class="position-relative col-6 mb-3 d-none" id="subcategory_exists">
                                <div class="form-floating">
                                    <select class="form-select" name="products_sub_categories_id" id="subcategory_id" aria-label="Floating label select example" required>
                                        @if($current_category != 'no')
                                            @if(!$current_category->subcategory->isEmpty())
                                                @foreach($current_category->subcategory as $subcategory)
                                                    <option value="{{$subcategory->id}}" {{$subcategory->id == $current_sub_category_id?'selected':''}}>{{$subcategory->name}}</option>
                                                @endforeach
                                            @endif
                                        @endif
                                    </select>
                                    <div class="invalid-tooltip">
                                        {{translate_title('Please select subcategory.', $lang)}}
                                    </div>
                                    <label for="subcategory_id">{{translate_title('Products sub categories', $lang)}}</label>
                                </div>
                            </div>
                            <div class="position-relative col-6">
                                <label for="name" class="form-label">{{translate_title('Name', $lang)}}</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{$product->name}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter name.', $lang)}}
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="amount" class="form-label">{{translate_title('Amount', $lang)}}</label>
                                <input type="text" id="amount" class="form-control" name="amount" value="{{$product->amount}}">
                            </div>
                            <div class="position-relative col-6">
                                <label for="price" class="form-label">{{translate_title('Price', $lang)}}</label>
                                <input type="text" id="price" class="form-control" name="price" value="{{$product->price}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter price.', $lang)}}
                                </div>
                            </div>
                            <div class="position-relative col-6">
                                <label for="cost" class="form-label">{{translate_title('Cost', $lang)}}</label>
                                <input type="text" id="cost" class="form-control" name="cost" value="{{$product->cost}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter cost.', $lang)}}
                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-around">
                                <label class="form-label">{{translate_title('Fast selling foods', $lang)}}</label>
                                <input type="checkbox" id="fast_selling_goods" {{$product->fast_selling_goods == 1?'checked':''}} data-plugin="switchery" data-color="#3db9dc" name="fast_selling_goods"/>
                            </div>
                            <div class="col-6">
                                <label for="description" class="form-label">{{translate_title('Description', $lang)}}</label>
                                <textarea id="description" class="form-control" name="description" rows="4">{{$product_info->description}}</textarea>
                            </div>
                            <div class="position-relative col-6">
                                <label for="barcode" class="form-label">{{translate_title('Barcode', $lang)}}</label>
                                <input type="text" id="barcode" class="form-control" name="barcode" value="{{$product->barcode}}">
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter barcode.', $lang)}}
                                </div>
                            </div>
                            <div class="position-relative col-6">
                                <label for="stock" class="form-label">{{translate_title('Stock', $lang)}}</label>
                                <input type="number" id="stock" class="form-control" name="stock" value="{{$product->stock}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter stock', $lang)}}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="image_input" class="form-label">{{translate_title('Image icon', $lang)}}</label>
                                    <div class="d-flex justify-content-center">
                                        <img onclick="showImage('{{$small_image}}')" data-bs-toggle="modal" data-bs-target="#images-modal" src="{{$small_image}}" alt="" height="100px">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="image_input_" class="form-label">{{translate_title('Image icon', $lang)}}</label>
                                    <div class="d-flex">
                                        <div class="default_image_content_">
                                            <img src="{{asset('img/default_image_plus.png')}}" alt="">
                                        </div>
                                        <span class="ms-1" id="images_quantity_"></span>
                                    </div>
                                    <input type="file" id="image_input_" name="small_image" class="form-control d-none" multiple>
                                </div>
                            </div>
                            <div class="col-6 d-flex overflow-auto">
                                @php
                                    $i = -1;
                                @endphp
                                @foreach($images as $image)
                                    @php
                                        $i = $i + 1;
                                        if(!$image){
                                            $image = 'no';
                                        }
                                    @endphp
                                    @php
                                        $avatar_main = storage_path('app/public/products/'.$image);
                                    @endphp
                                    @if(file_exists(storage_path('app/public/products/'.$image)))
                                        <div class="mb-3 product_image">
                                            <div class="d-flex justify-content-between">
                                                <img src="{{asset('storage/products/'.$image)}}" alt="">
                                                <a class="delete_product_func" onclick="deleteProductFunc('{{$image}}', '{{$i}}')">X</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="image_input" class="form-label">{{translate_title('Images', $lang)}}</label>
                                    <div class="d-flex">
                                        <div class="default_image_content">
                                            <img src="{{asset('img/default_image_plus.png')}}" alt="">
                                        </div>
                                        <span class="ms-1" id="images_quantity"></span>
                                    </div>
                                    <input type="file" id="image_input" name="images[]" class="form-control d-none" multiple>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="position-relative form-floating mb-3">
                                    <select class="form-select" name="unit" id="unit" aria-label="Floating label select example">
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}" {{$product->unit_id == $unit->id?'selected':''}}>{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="unit">{{translate_title('Unit', $lang)}}</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">{{translate_title('Manufactured date', $lang)}}</label>
                                    <input type="text" name="manufactured_date" value="{{$product_info->manufactured_date}}" class="form-control basic-datepicker" placeholder="Date and Time">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">{{translate_title('Expired date', $lang)}}</label>
                                    <input type="text" value="{{$product_info->expired_date}}" name="expired_date" class="form-control basic-datepicker" placeholder="Date and Time">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="status" id="floatingSelect" aria-label="Floating label select example">
                                        <option value="0" {{$product_info->status == 0?'selected':''}}>{{translate_title('Active', $lang)}}</option>
                                        <option value="1" {{$product_info->status == 1?'selected':''}}>{{translate_title('Not active', $lang)}}</option>
                                    </select>
                                    <label for="floatingSelect">{{translate_title('Status', $lang)}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mt-4 justify-content-end width_100_percent">
                            <button type="submit" class="btn modal_confirm">{{translate_title('Update', $lang)}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let product_image = document.getElementsByClassName('product_image')
        let delete_product_func = document.getElementsByClassName('delete_product_func')
        let deleted_text = "{{translate_title('Product image was deleted', $lang)}}"
        let product_images = []
        @if(is_array($images))
            @foreach($images as $image)
                product_images.push("{{$image}}")
            @endforeach
        @endif

        let subcategory_exists = document.getElementById('subcategory_exists')
        let current_sub_category_id = "{{$current_sub_category_id}}"
        let category_id = document.getElementById('category_id')
        let subcategory_id = document.getElementById('subcategory_id')

        let disabled_text = "{{translate_title('Select sub category', $lang)}}"

        if(current_sub_category_id != 'no'){
            if(subcategory_exists.classList.contains('d-none')){
                subcategory_exists.classList.remove('d-none')
            }
        }
        category_id.addEventListener('change', function () {
            getSubcategory(subcategory_exists, category_id, subcategory_id, disabled_text)
        })

        function deleteProductFunc(image_name, index){
            $.ajax({
                url: '/api/cashier-delete-product',
                method: 'POST',
                dataType: 'json',
                data: {
                    id:"{{$product->id}}",
                    store_id:"{{$user->store_id}}",
                    product_name: image_name
                },
                success: function(data){
                    if(data.status == true){
                        toastr.success(deleted_text)
                    }
                }
            });
            if(!product_image[index].classList.contains('display-none')){
                product_image[index].classList.add('display-none')
            }
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
    <script src="{{asset('js/product.js')}}"></script>

@endsection
