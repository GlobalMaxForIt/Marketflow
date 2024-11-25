@extends('layouts.superadmin_layout')

@section('title')
    {{translate_title('Edit products\' category')}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt-0 header-title">{{translate_title('Edit products\' sub category')}}</h4>
                </div>
                <div class="card-body">
                    <form class="modal-body needs-validation" action="{{route('products-sub-categories.update', $products_sub_category->id)}}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="position-relative form-floating mb-3">
                                <select class="form-select" name="products_categories_id" id="category_id_" aria-label="Floating label select example" required>
                                    <option value="" selected disabled>{{translate_title('Select category')}}</option>
                                    @foreach($products_categories as $products_category)
                                        <option value="{{$products_category->id}}" {{$products_sub_category->parent_id == $products_category->id?'selected':''}}>{{$products_category->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please select category.')}}
                                </div>
                                <label for="category_id_">{{translate_title('Products categories')}}</label>
                            </div>
                            <div class="position-relative col-4">
                                <label for="name" class="form-label">{{translate_title('Name')}}</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{$products_sub_category->name}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter percent.')}}
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-center">
                                <img onclick="showImage('{{$products_sub_category->image?asset("storage/categories/$products_sub_category->image"):asset('icon/no_photo.jpg')}}')" data-bs-toggle="modal" data-bs-target="#images-modal" src="{{$products_sub_category->image?asset("storage/categories/$products_sub_category->image"):asset('icon/no_photo.jpg')}}" alt="" height="144px">
                            </div>
                            <div class="col-4">
                                <label for="name" class="form-label">{{translate_title('Image')}}</label>
                                <input type="file" id="image" class="form-control" name="image" value="">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end width_100_percent">
                            <a type="submit" class="btn modal_confirm">{{translate_title('Update')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let sessionSuccess ="{{session('status')}}";
        if(sessionSuccess){
            toastr.success(sessionSuccess)
        }
        let sessionError ="{{session('error')}}";
        if(sessionError){
            toastr.warning(sessionError)
        }
    </script>
@endsection
