@extends('layouts.superadmin_layout')

@section('title')
    {{translate_title('Edit employee')}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt-0 header-title">{{translate_title('Edit stores')}}</h4>
                </div>
                <div class="card-body">
                    <form class="modal-body needs-validation" action="{{route('stores.update', $store['id'])}}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="position-relative col-6 mb-3">
                                <label for="name" class="form-label">{{translate_title('Name')}}</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{$store['name']}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter name.')}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 d-flex overflow-auto">
                                @foreach($store['images'] as $image)
                                    <div class="mb-3 product_image">
                                        <div class="d-flex justify-content-between">
                                            <img src="{{$image}}" alt="">
                                            <a class="delete_product_func">X</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-6">

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
                            </div>
                        </div>
                        <div class="row">
                            <div class="position-relative col-6 mb-3">
                                <label class="form-label">{{translate_title('Region')}}</label>
                                <select name="region_id" class="form-control" id="region_id" required>
                                    <option value="" disabled selected>{{translate_title('Select region')}}</option>
                                </select>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter region.')}}
                                </div>
                            </div>
                            <div class="position-relative col-6 mb-3">
                                <label class="form-label">{{translate_title('District')}}</label>
                                <select name="district_id" class="form-control" id="district_id" required>
                                    <option value="" disabled selected>{{translate_title('Select district')}}</option>
                                </select>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter district.')}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="position-relative mb-3">
                                <label class="form-label" id="organization_id">{{translate_title('Organization')}}</label>
                                <select name="organization_id" class="form-control" id="organization_id" required>
                                    <option value="" disabled selected>{{translate_title('Select organization')}}</option>
                                    @foreach($organizations as $organization)
                                        <option value="{{$organization['id']}}" {{$organization['id'] == $store['organization_id']}}>{{$organization['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please select organization.')}}
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="address" class="form-label">{{translate_title('Address')}}</label>
                                <input type="text" id="address" class="form-control" name="address" value="{{$store['address']?$store['address']->name:''}}">
                            </div>
                        </div>
                        <input type="hidden" name="region" id="region">
                        <input type="hidden" name="district" id="district">
                        <div class="d-flex justify-content-end width_100_percent">
                            <button type="submit" class="btn modal_confirm">{{translate_title('Update')}}</button>
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
        let deleted_text = "{{translate_title('Product image was deleted')}}"
        let product_images = []
        @if(is_array($images))
            @foreach($images as $image)
                product_images.push("{{$image}}")
            @endforeach
        @endif


        function deleteProductFunc(item, val) {
            delete_product_func[item].addEventListener('click', function (e) {
                e.preventDefault()
                $.ajax({
                    url: '/api/delete-company',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        id:"{{$store['id']}}",
                        product_name: product_images[item]
                    },
                    success: function(data){
                        if(data.status == true){
                            toastr.success(deleted_text)
                        }
                    }
                });
                if(!product_image[item].classList.contains('display-none')){
                    product_image[item].classList.add('display-none')
                }
            })
        }
        Object.keys(delete_product_func).forEach(deleteProductFunc)


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
