@extends('layouts.superadmin_layout')

@section('title')
    {{translate_title('Edit employee', $lang)}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt-0 header-title">{{translate_title('Edit stores', $lang)}}</h4>
                </div>
                <div class="card-body">
                    <form class="modal-body needs-validation" action="{{route('stores.update', $store['id'])}}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="position-relative col-6 mb-3">
                                <label for="name" class="form-label">{{translate_title('Name', $lang)}}</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{$store['name']}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter name.', $lang)}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 d-flex overflow-auto">
                                @php
                                    $i = -1;
                                @endphp
                                @foreach($store['images'] as $image)
                                    @php
                                        $i = $i + 1;
                                        $image_text = explode('/', $image);
                                        $image_name = end($image_text)
                                    @endphp
                                    <div class="mb-3 product_image">
                                        <div class="d-flex justify-content-between">
                                            <img src="{{$image}}" alt="">
                                            <a class="delete_product_func" onclick="deleteProductFunc('{{$image_name}}', '{{$i}}')">X</a>
                                        </div>
                                    </div>
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
                        </div>
                        <div class="row">
                            <div class="position-relative col-6 mb-3">
                                <label class="form-label">{{translate_title('Region', $lang)}}</label>
                                <select name="region_id" class="form-control" id="region_id" required>
                                    <option value="" disabled selected>{{translate_title('Select region', $lang)}}</option>
                                </select>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter region.', $lang)}}
                                </div>
                            </div>
                            <div class="position-relative col-6 mb-3">
                                <label class="form-label">{{translate_title('District', $lang)}}</label>
                                <select name="district_id" class="form-control" id="district_id" required>
                                    <option value="" disabled selected>{{translate_title('Select district', $lang)}}</option>
                                </select>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter district.', $lang)}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="position-relative mb-3">
                                <label class="form-label" id="organization_id">{{translate_title('Organization', $lang)}}</label>
                                <select name="organization_id" class="form-control" id="organization_id" required>
                                    <option value="" disabled selected>{{translate_title('Select organization', $lang)}}</option>
                                    @foreach($organizations as $organization)
                                        <option value="{{$organization['id']}}" {{$organization['id'] == $store['organization_id']}}>{{$organization['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please select organization.', $lang)}}
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="address" class="form-label">{{translate_title('Address', $lang)}}</label>
                                <input type="text" id="address" class="form-control" name="address" value="{{$store['address']?$store['address']->name:''}}">
                            </div>
                        </div>
                        <input type="hidden" name="region" id="region">
                        <input type="hidden" name="district" id="district">
                        <div class="d-flex justify-content-end width_100_percent">
                            <button type="submit" class="btn modal_confirm">{{translate_title('Update', $lang)}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/stuffs.js')}}"></script>
    <script>
        let page = true
        @if($store['address'])
            @if($store['address']->cities)
                let current_region = "{{$store['address']->cities->region?$store['address']->cities->region->id:''}}"
                let current_district = "{{$store['address']->cities->id??''}}"
            @else
                let current_region = ''
                let current_district = ''
            @endif
        @else
            let current_region = ''
            let current_district = ''
        @endif
        let product_image = document.getElementsByClassName('product_image')
        let delete_product_func = document.getElementsByClassName('delete_product_func')
        let deleted_text = "{{translate_title('Product image was deleted', $lang)}}"
        let product_images = []
        @if(is_array($images))
            @foreach($images as $image)
                product_images.push("{{$image}}")
            @endforeach
        @endif

        function deleteProductFunc(image_name, index){
            $.ajax({
                url: '/api/delete-store',
                method: 'POST',
                dataType: 'json',
                data: {
                    id:"{{$store['id']}}",
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
    <script src="{{asset('js/cities.js')}}"></script>
@endsection
