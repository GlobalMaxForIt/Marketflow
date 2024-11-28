@extends('layouts.superadmin_layout')

@section('title')
     {{translate_title('Products categories', $lang)}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section">
            <ul class="nav nav-tabs mb-4" id="myCategory" role="tablist">
                <li class="nav-item ms-2 width_20_percent">
                    <a href="#products_categories" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        {{translate_title("Категории продуктов", $lang)}}
                        @if($products_categories)
                            <span class="badge bg-danger_">{{count($products_categories)}}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item ms-2 width_20_percent">
                    <a href="#products_sub_categories" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        {{translate_title("Подкатегории продуктов", $lang)}}
                        @if($products_sub_categories)
                            <span class="badge bg-danger_">{{count($products_sub_categories)}}</span>
                        @endif
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myCategory">
                <div class="tab-pane fade show active" id="products_categories" role="tabpanel" aria-labelledby="products_categories-tab">
                    <div class="card">
                        <div class="right_button_create">
                            <a class="form_functions mt-3 global-button" data-bs-toggle="modal" data-bs-target="#create_category_modal" data-url="{{route('products-categories.store')}}">
                                <img src="{{asset('img/client_icon.png')}}" alt="" height="20px">
                                {{translate_title('New products category', $lang)}}
                            </a>
                        </div>
                        <div class="card-body overflow-auto">
                            <table class="restaurant_tables datatable table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th>{{translate_title('Id', $lang)}}</th>
                                    <th>{{translate_title('Name', $lang)}}</th>
                                    <th>{{translate_title('Image', $lang)}}</th>
                                    <th>{{translate_title('Functions', $lang)}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products_categories as $products_category)
                                    <tr>
                                        <td>{{$products_category['id']}}</td>
                                        <td>{{$products_category['name']}}</td>
                                        <td>
                                            <img onclick="showImage('{{$products_category['image']}}')" data-bs-toggle="modal" data-bs-target="#images-modal" src="{{$products_category['image']}}" alt="" height="100px">
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around align-items-center">
                                                <a class="btn edit_button " href="{{route('products-categories.edit', $products_category['id'])}}"><i class="fe-edit-2"></i></a>
                                                <a type="button" class="btn delete_button btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('products-categories.destroy', $products_category['id'])}}"><i class="fe-trash-2"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="products_sub_categories" role="tabpanel" aria-labelledby="products_sub_categories-tab">
                    <div class="card">
                        <div class="right_button_create">
                            <a class="form_functions mt-3 global-button" data-bs-toggle="modal" data-bs-target="#create_sub_category_modal" data-url="{{route('products-sub-categories.store')}}">
                                <img src="{{asset('img/client_icon.png')}}" alt="" height="20px">
                                {{translate_title('New products category', $lang)}}
                            </a>
                        </div>
                        <div class="card-body overflow-auto">
                            <table class="restaurant_tables datatable table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th>{{translate_title('Id', $lang)}}</th>
                                    <th>{{translate_title('Name', $lang)}}</th>
                                    <th>{{translate_title('Image', $lang)}}</th>
                                    <th>{{translate_title('Functions', $lang)}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products_sub_categories as $products_sub_category)
                                    <tr>
                                        <td>{{$products_sub_category['id']}}</td>
                                        <td>{{$products_sub_category['name']}}</td>
                                        <td>
                                            <img onclick="showImage('{{$products_sub_category['image']}}')" data-bs-toggle="modal" data-bs-target="#images-modal" src="{{$products_sub_category['image']}}" alt="" height="100px">
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around align-items-center">
                                                <a class="btn edit_button" href="{{route('products-sub-categories.edit', $products_sub_category['id'])}}"><i class="fe-edit-2"></i></a>
                                                <a type="button" class="btn delete_button btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('products-sub-categories.destroy', $products_sub_category['id'])}}"><i class="fe-trash-2"></i></a>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="create_category_modal"
         aria-labelledby="scrollableModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('New products category', $lang)}}</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <form class="modal-body needs-validation" action="{{route('products-categories.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('POST')
                    <div class="position-relative mb-3">
                        <label for="name" class="form-label">{{translate_title('Name', $lang)}}</label>
                        <input type="text" id="name" class="form-control" name="name" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter category name.', $lang)}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image_input_" class="form-label">{{translate_title('Image', $lang)}}</label>
                        <div class="d-flex">
                            <div class="default_image_content_ default_image_content">
                                <img src="{{asset('img/default_image_plus.png')}}" alt="">
                            </div>
                            <span class="ms-1" id="images_quantity_"></span>
                        </div>
                        <input type="file" id="image_input_" name="image" class="form-control d-none">
                    </div>
                    <div class="d-flex justify-content-between width_100_percent">
                        <a type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</a>
                        <button type="submit" class="btn modal_confirm">{{translate_title('Create', $lang)}}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="create_sub_category_modal"
         aria-labelledby="scrollableModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('New products sub category', $lang)}}</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <form class="modal-body needs-validation" action="{{route('products-sub-categories.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('POST')
                    <div class="position-relative form-floating mb-3">
                        <select class="form-select" name="products_categories_id" id="category_id_" aria-label="Floating label select example" required>
                            <option value="" selected disabled>{{translate_title('Select category', $lang)}}</option>
                            @foreach($products_categories as $products_category)
                                <option value="{{$products_category['id']}}">{{$products_category['name']}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Please select category.', $lang)}}
                        </div>
                        <label for="category_id_">{{translate_title('Products categories', $lang)}}</label>
                    </div>
                    <div class="position-relative mb-3">
                        <label for="name" class="form-label">{{translate_title('Name', $lang)}}</label>
                        <input type="text" id="name" class="form-control" name="name" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter subcategory name.', $lang)}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image_input__" class="form-label">{{translate_title('Image', $lang)}}</label>
                        <div class="d-flex">
                            <div class="default_image_content__ default_image_content">
                                <img src="{{asset('img/default_image_plus.png')}}" alt="">
                            </div>
                            <span class="ms-1" id="images_quantity__"></span>
                        </div>
                        <input type="file" id="image_input__" name="image" class="form-control d-none">
                    </div>
                    <div class="d-flex justify-content-between width_100_percent">
                        <a type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</a>
                        <button type="submit" class="btn modal_confirm">{{translate_title('Create', $lang)}}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
