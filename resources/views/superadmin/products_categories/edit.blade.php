@extends('layouts.superadmin_layout')

@section('title')
    {{translate_title('Edit products\' category', $lang)}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt-0 header-title">{{translate_title('Edit products\' category', $lang)}}</h4>
                </div>
                <div class="card-body">
                    <form class="modal-body needs-validation" action="{{route('products-categories.update', $products_category->id)}}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="position-relative col-4">
                                <label for="name" class="form-label">{{translate_title('Name', $lang)}}</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{$products_category->name}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter percent.', $lang)}}
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-center">
                                <img onclick="showImage('{{$products_category->image?asset("storage/categories/$products_category->image"):asset('icon/no_photo.jpg')}}')" data-bs-toggle="modal" data-bs-target="#images-modal" src="{{$products_category->image?asset("storage/categories/$products_category->image"):asset('icon/no_photo.jpg')}}" alt="" height="144px">
                            </div>
                            <div class="col-4">
                                <label for="name" class="form-label">{{translate_title('Image', $lang)}}</label>
                                <input type="file" id="image" class="form-control" name="image" value="">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end width_100_percent">
                            <button type="submit" class="btn modal_confirm">{{translate_title('Update', $lang)}}</button>
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
