@extends('layouts.superadmin_layout')

@section('title')
    {{translate_title('Products')}}
@endsection
@section('content')
{{--    <script src="{{ asset('node_modules/html2pdf.js/dist/html2pdf.bundle.js') }}"></script>--}}
    <div class="main-content-section">
        <div class="order-section">
            <div class="tab-content" id="myCategory">
                <div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="products-tab">
                    <ul class="nav nav-tabs mb-2">
                        <li class="nav-item ms-2 mb-2">
                            <a href="#all_category" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                {{translate_title("All products")}}
                                @if($allProductsData['quantity']>0)
                                    <span class="badge bg-danger_">{{$allProductsData['quantity']}}</span>
                                @endif
                            </a>
                        </li>
                        @foreach($products_categories as $category)
                            <li class="nav-item ms-2 mb-2">
                                <a href="#category_{{$category['id']}}" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                    {{$category['name']??''}}
                                    @if($category['quantity']>0)
                                        <span class="badge bg-danger_">{{$category['quantity']}}</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myCategory_">
                        <div class="tab-pane fade show active" id="all_category" role="tabpanel" aria-labelledby="all_category-tab">
                            <div class="card">
                                <div class="right_button_create">
                                    <a class="form_functions global-button" data-bs-toggle="modal" data-bs-target="#create_modal" data-url="{{route('product.store')}}">
                                        <img src="{{asset('menubar/products_active.png')}}" alt="" height="20px">
                                        {{translate_title('Новый продукт')}}
                                    </a>
                                </div>
                                <div class="card-body overflow-auto">
                                    <table id="datatable-buttons" class="restaurant_tables table table-striped dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>{{translate_title('Id')}}</th>
                                                <th>{{translate_title('Name')}}</th>
                                                <th>{{translate_title('Amount')}}</th>
                                                <th>{{translate_title('Barcode')}}</th>
                                                <th>{{translate_title('Stock')}}</th>
                                                <th>{{translate_title('Price')}}</th>
                                                <th>{{translate_title('Functions')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($allProductsData['products'] as $product)
                                            <tr>
                                                <td>{{$product['id']}}</td>
                                                <td>{{$product['name']}}</td>
                                                <td>{{$product['amount']}}</td>
                                                <td>{{$product['barcode']}}</td>
                                                <td>{{$product['stock']}}</td>
                                                <td>
                                                    <div><span>{{$product['last_price']}}</span></div>
                                                    @if($product['discount']>0)
                                                        <del>{{$product['price']}}</del>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center height_50 function_buttons">
                                                        <a class="edit_button btn" href="{{route('product.edit', $product['id'])}}">
                                                            <img src="{{asset('img/edit_icon.png')}}" alt="" height="18px">
                                                        </a>
                                                        <a class="edit_button btn me-2" href="{{route('product.show', $product['id'])}}">
                                                            <span class="fa fa-eye height_18"></span>
                                                        </a>
                                                        <a type="button" class="btn delete_button btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('product.destroy', $product['id'])}}">
                                                            <img src="{{asset('img/trash_icon.png')}}" alt="" height="18px">
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @foreach($all_products as $key => $products)
                            <div class="tab-pane fade" id="category_{{$key}}" role="tabpanel" aria-labelledby="category_{{$key}}-tab">
                                <ul class="nav nav-tabs mb-4">
                                    @foreach($productsSubCategories[$key] as $sub_category)
                                        <li class="nav-item ms-2 mb-2">
                                            <a href="#category_{{$sub_category['id']}}" data-bs-toggle="tab" aria-expanded="false" class="sub_category nav-link">
                                                {{$sub_category['name']??''}}
                                                @if(count($all_products[$sub_category['id']]) > 0)
                                                    <span class="badge bg-danger_">{{count($all_products[$sub_category['id']])}}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="card">
                                    <div class="right_button_create">
                                        <a class="form_functions global-button" data-bs-toggle="modal" data-bs-target="#create_modal" data-url="{{route('product.store')}}">
                                            <img src="{{asset('menubar/products_active.png')}}" alt="" height="20px">
                                            {{translate_title('Новый продукт')}}
                                        </a>
                                    </div>
                                    <div class="card-body overflow-auto">
                                        <table class="restaurant_tables table datatable table-striped dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>{{translate_title('Id')}}</th>
                                                    <th>{{translate_title('Name')}}</th>
                                                    <th>{{translate_title('Amount')}}</th>
                                                    <th>{{translate_title('Barcode')}}</th>
                                                    <th>{{translate_title('Stock')}}</th>
                                                    <th>{{translate_title('Price')}}</th>
                                                    <th>{{translate_title('Functions')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $product)
                                                @if(!empty($product))
                                                    <tr>
                                                        <td>{{$product['id']}}</td>
                                                        <td>{{$product['name']}}</td>
                                                        <td>{{$product['amount']}}</td>
                                                        <td>{{$product['barcode']}}</td>
                                                        <td>{{$product['stock']}}</td>
                                                        <td>
                                                            <div><span>{{$product['last_price']}}</span></div>
                                                            @if($product['discount']>0)
                                                                <del>{{$product['price']}}</del>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-around align-items-center height_50 function_buttons">
                                                                <a class="edit_button btn" href="{{route('product.edit', $product['id'])}}">
                                                                    <img src="{{asset('img/edit_icon.png')}}" alt="" height="18px">
                                                                </a>
                                                                <a class="edit_button btn me-2" href="{{route('product.show', $product['id'])}}">
                                                                    <span class="fa fa-eye height_18"></span>
                                                                </a>
                                                                <a type="button" class="btn delete_button btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('product.destroy', $product['id'])}}">
                                                                    <img src="{{asset('img/trash_icon.png')}}" alt="" height="18px">
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Tab panes -->
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="create_modal"
         aria-labelledby="scrollableModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('New product')}}</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <form class="modal-body needs-validation" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('POST')
                    <div class="position-relative form-floating mb-3">
                        <select class="form-select" name="products_categories_id" id="category_id" aria-label="Floating label select example" required>
                            <option value="" selected disabled>{{translate_title('Select category')}}</option>
                            @foreach($products_categories as $products_category)
                                <option value="{{$products_category['id']}}">{{$products_category['name']}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Please select category')}}
                        </div>
                        <label for="category_id">{{translate_title('Products categories')}}</label>
                    </div>
                    <div class="position-relative form-floating mb-3 d-none" id="subcategory_exists">
                        <select class="form-select" name="products_sub_categories_id" id="subcategory_id" aria-label="Floating label select example" required>

                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Please select subcategory')}}
                        </div>
                        <label for="subcategory_id">{{translate_title('Products sub categories')}}</label>
                    </div>
                    <div class="position-relative mb-3">
                        <label for="name" class="form-label">{{translate_title('Name')}}</label>
                        <input type="text" id="name" class="form-control" name="name" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter name')}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">{{translate_title('Amount')}}</label>
                        <input type="text" id="amount" class="form-control" name="amount">
                    </div>
                    <div class="position-relative mb-3">
                        <label for="price" class="form-label">{{translate_title('Price')}}</label>
                        <input type="text" id="price" class="form-control" name="price" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter price')}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">{{translate_title('Description')}}</label>
                        <textarea id="description" class="form-control" name="description" cols="30" rows="10"></textarea>
                    </div>
                    <div class="position-relative mb-3">
                        <label for="barcode" class="form-label">{{translate_title('Barcode')}}</label>
                        <input type="text" id="barcode" class="form-control" name="barcode" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter barcode')}}
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label for="stock" class="form-label">{{translate_title('Stock')}}</label>
                        <input type="number" id="stock" class="form-control" name="stock" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter stock')}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image_input" class="form-label">{{translate_title('Images')}}</label>
                        <div class="d-flex">
                            <div class="default_image_content">
                                <img src="{{asset('img/default_image_plus.png')}}" alt="">
                            </div>
                            <span class="ms-1" id="images_quantity"></span>
                        </div>
                        <input type="file" id="image_input" name="images[]" class="form-control d-none" multiple>
                    </div>
                    <div class="position-relative form-floating mb-3">
                        <select class="form-select" name="unit" id="unit" aria-label="Floating label select example" required>
                            @foreach($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                            @endforeach
                        </select>
                        <label for="unit">{{translate_title('Unit')}}</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{translate_title('Manufactured date')}}</label>
                        <input type="text" name="manufactured_date" class="form-control basic-datepicker" placeholder="Date and Time">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{translate_title('Expired date')}}</label>
                        <input type="text" name="expired_date" class="form-control basic-datepicker" placeholder="Date and Time">
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="status" id="floatingSelect" aria-label="Floating label select example">
                            <option value="0">{{translate_title('Active')}}</option>
                            <option value="1">{{translate_title('Not active')}}</option>
                        </select>
                        <label for="floatingSelect">{{translate_title('Status')}}</label>
                    </div>
                    <div class="d-flex justify-content-between width_100_percent">
                        <a type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close')}}</a>
                        <a type="submit" class="btn modal_confirm">{{translate_title('Create')}}</a>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
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
<script>
    let subcategory_exists = document.getElementById('subcategory_exists')
    let category_id = document.getElementById('category_id')
    let subcategory_id = document.getElementById('subcategory_id')

    let disabled_text = "{{translate_title('Select sub category')}}"

    category_id.addEventListener('change', function () {
        getSubcategory(subcategory_exists, category_id, subcategory_id, disabled_text)
    })

</script>
<script src="{{asset('js/product.js')}}"></script>
@endsection
