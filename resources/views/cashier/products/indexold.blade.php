@extends('layouts.cashier_layout')

@section('title')
    {{translate_title('Product')}}
@endsection
@section('content')
    <script src="{{ asset('node_modules/html2pdf.js/dist/html2pdf.bundle.js') }}"></script>
    <div class="main-content-section">
        <div class="order-section">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt-0 header-title">{{translate_title('Products lists')}}</h4>
                    <div class="dropdown float-end">
                        <button class="form_functions btn btn-success"  href="{{route('product.create')}}"  data-bs-toggle="modal" data-bs-target="#create_modal" data-url="{{route('product.store')}}">{{translate_title('Create')}}</button>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item ms-2 mb-2">
                            <a href="#all_category" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                {{translate_title("All products")}}
                                @if($allProductsData['quantity']>0)
                                    <span class="badge bg-danger_">{{$allProductsData['quantity']}}</span>
                                @endif
                            </a>
                        </li>
                        @php
                            $i = 0;
                        @endphp
                        @foreach($products_categories as $category)
                            @php
                                $i++;
                            @endphp
                            <li class="nav-item ms-2 mb-2">
                                <a href="#category_{{$category->id}}" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                    {{$category->name??''}}
                                    @if(count($all_products[$category->id]) > 0)
                                        <span class="badge bg-danger_">{{count($all_products[$category->id])}}</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="all_category" role="tabpanel" aria-labelledby="home-tab">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th>{{translate_title('Id')}}</th>
                                    <th>{{translate_title('Product category')}}</th>
                                    <th>{{translate_title('Name')}}</th>
                                    <th>{{translate_title('Amount')}}</th>
                                    <th>{{translate_title('Price')}}</th>
                                    <th>{{translate_title('Barcode')}}</th>
                                    <th>{{translate_title('Description')}}</th>
                                    <th>{{translate_title('Images')}}</th>
                                    <th>{{translate_title('Status')}}</th>
                                    <th>{{translate_title('Functions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allProductsData['products'] as $product)
                                    <tr>
                                        <td>{{$product['id']}}</td>
                                        <td>
                                            @if($product['products_categories'])
                                                {{$product['products_categories']->name??''}}
                                            @endif
                                        </td>
                                        <td>{{$product['name']}}</td>
                                        <td>{{$product['amount']}}</td>
                                        <td>{{$product['price']}}</td>
                                        <td>{{$product['barcode']}}</td>
                                        <td>
                                            <div class="description_column">
                                                {{$product['description']}}
                                            </div>
                                        </td>
                                        <td>
                                            <a class="product_images_column" onclick='getImages("{{implode(" ", $product['images'])}}")' data-bs-toggle="modal" data-bs-target="#carousel-modal">
                                                @foreach($product['images'] as $image)
                                                    <div style="margin-right: 2px">
                                                        <img src="{{$image}}" alt="" height="50px">
                                                    </div>
                                                @endforeach
                                            </a>
                                        </td>
                                        <td>
                                            @if($product['status'] == 0)
                                                {{translate_title('Active')}}
                                            @elseif($product['status'] == 1)
                                                {{translate_title('Not active')}}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around align-items-center height_50">
                                                <a class="form_functions btn btn-info" href="{{route('product.edit', $product['id'])}}"><i class="fe-edit-2"></i></a>
                                                <button type="button" class="btn btn-danger delete_button btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('product.destroy', $product['id'])}}"><i class="fe-trash-2"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @php
                            $j = 0;
                        @endphp
                        @foreach($products_categories as $category)
                            @php
                                $j++;
                            @endphp
                            <div class="tab-pane fade" id="category_{{$category->id}}" role="tabpanel" aria-labelledby="home-tab">
                                <table class="table datatable table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                    <tr>
                                        <th>{{translate_title('Id')}}</th>
                                        <th>{{translate_title('Product category')}}</th>
                                        <th>{{translate_title('Name')}}</th>
                                        <th>{{translate_title('Amount')}}</th>
                                        <th>{{translate_title('Price')}}</th>
                                        <th>{{translate_title('Barcode')}}</th>
                                        <th>{{translate_title('Description')}}</th>
                                        <th>{{translate_title('Images')}}</th>
                                        <th>{{translate_title('Status')}}</th>
                                        <th>{{translate_title('Functions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($all_products[$category->id] as $product)
                                        <tr>
                                            <td>{{$product['id']}}</td>
                                            <td>
                                                @if($product['products_categories'])
                                                    {{$product['products_categories']->name??''}}
                                                @endif
                                            </td>
                                            <td>{{$product['name']}}</td>
                                            <td>{{$product['amount']}}</td>
                                            <td>{{$product['price']}}</td>
                                            <td>{{$product['barcode']}}</td>
                                            <td>
                                                <div class="description_column">
                                                    {{$product['description']}}
                                                </div>
                                            </td>
                                            <td>
                                                <a class="product_images_column" onclick='getImages("{{implode(" ", $product['images'])}}")' data-bs-toggle="modal" data-bs-target="#carousel-modal">
                                                    @foreach($product['images'] as $image)
                                                        <div style="margin-right: 2px">
                                                            <img src="{{$image}}" alt="" height="50px">
                                                        </div>
                                                    @endforeach
                                                </a>
                                            </td>
                                            <td>
                                                @if($product['status'] == 0)
                                                    {{translate_title('Active')}}
                                                @elseif($product['status'] == 1)
                                                    {{translate_title('Not active')}}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-around align-items-center height_50">
                                                    <a class="form_functions btn btn-info" href="{{route('product.edit', $product['id'])}}"><i class="fe-edit-2"></i></a>
                                                    <button type="button" class="btn btn-danger delete_button btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('product.destroy', $product['id'])}}"><i class="fe-trash-2"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
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
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('Product create')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body" action="{{route('product.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-floating mb-3">
                        <select class="form-select" name="products_categories_id" id="floatingSelect" aria-label="Floating label select example">
                            @foreach($products_categories as $products_category)
                                <option value="{{$products_category->id}}">{{$products_category->name}}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">{{translate_title('Products categories')}}</label>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">{{translate_title('Products')}}</label>
                        <input type="text" id="name" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">{{translate_title('Amount')}}</label>
                        <input type="text" id="amount" class="form-control" name="amount">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">{{translate_title('Price')}}</label>
                        <input type="text" id="price" class="form-control" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">{{translate_title('Description')}}</label>
                        <textarea id="description" class="form-control" name="description" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="barcode" class="form-label">{{translate_title('Barcode')}}</label>
                        <input type="text" id="barcode" class="form-control" name="description">
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label">{{translate_title('Images')}}</label>
                        <input type="file" id="images[]" class="form-control" name="images" value="" multiple>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="status" id="floatingSelect" aria-label="Floating label select example">
                            <option value="0">{{translate_title('Active')}}</option>
                            <option value="1">{{translate_title('Not active')}}</option>
                        </select>
                        <label for="floatingSelect">{{translate_title('Products categories')}}</label>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{translate_title('Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{translate_title('Create')}}</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    <div id="carousel-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
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
    <script>
        let carousel_product_images = document.getElementById('carousel_product_images')
        function getImages(images) {
            let all_images = images.split(' ')
            let images_content = ''
            for(let i=0; i<all_images.length; i++){
                if(i == 0){
                    images_content = images_content +
                        `<div class="carousel-item active">
                    <img class="d-block img-fluid" src="${all_images[i]}" alt="First slide">
                </div>`
                }else{
                    images_content = images_content +
                        `<div class="carousel-item">
                    <img class="d-block img-fluid" src="${all_images[i]}" alt="First slide">
                </div>`
                }
            }
            carousel_product_images.innerHTML = images_content
        }

    </script>
@endsection
