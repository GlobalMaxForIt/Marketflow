@extends('layouts.superadmin_layout')

@section('title')
    {{translate_title('Employees', $lang)}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section">
            <!-- Tab panes -->
            <div class="card-body">
                <div class="tab-content" id="employees_">
                    <div class="tab-pane fade show active" id="employees" role="tabpanel" aria-labelledby="employees-tab">
                        <div class="card">
                            <div class="right_button_create">
                                <a class="form_functions global-button" data-bs-toggle="modal" data-bs-target="#create_modal">
                                    <img src="{{asset('menubar/employee_active.png')}}" alt="" height="20px">
                                    {{translate_title('Новый Сотрудник', $lang)}}
                                </a>
                            </div>
                            <div class="card-body overflow-auto">
                                <table id="datatable-buttons" class="restaurant_tables table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th><h6>{{translate_title('Id', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Name', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Address', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Images', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Organization', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Functions', $lang)}}</h6></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($stores as $store)
                                        <tr>
                                            <td class="show_page">{{$store['id']}}</h6></td>
                                            <td><h6>{{$store['name']}}</h6></td>
                                            <td><h6>{{$store['address']}}</h6></td>
                                            <td>
                                                <a class="product_images_column" onclick='getImages("{{implode(" ", $store['images'])}}")' data-bs-toggle="modal" data-bs-target="#carousel-modal">
                                                    @foreach($store['images'] as $image)
                                                        <div style="margin-right: 2px">
                                                            <img src="{{$image}}" alt="" height="50px">
                                                        </div>
                                                    @endforeach
                                                </a>
                                            </td>
                                            <td><h6>{{$store['organization']?$store['organization']->name:''}}</h6></td>
                                            <td>
                                                <div class="d-flex justify-content-around align-items-center height_50 function_buttons">
                                                    <a class="edit_button btn me-2" href="{{route('stores.edit', $store['id'])}}">
                                                        <img src="{{asset('img/edit_icon.png')}}" alt="" height="18px">
                                                    </a>
                                                    <a type="button" class="btn delete_button btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('stores.destroy', $store['id'])}}">
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
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="create_modal"
         aria-labelledby="scrollableModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('New store', $lang)}}</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <form class="modal-body needs-validation" action="{{route('stores.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('POST')
                    <div class="position-relative mb-3">
                        <label for="name" class="form-label">{{translate_title('Name', $lang)}}</label>
                        <input type="text" id="name" class="form-control" name="name" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter name.', $lang)}}
                        </div>
                    </div>
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
                    <div class="position-relative mb-3">
                        <label class="form-label">{{translate_title('Region', $lang)}}</label>
                        <select name="region_id" class="form-control" id="region_id" required>
                            <option value="" disabled selected>{{translate_title('Select region', $lang)}}</option>
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter percent.', $lang)}}
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label class="form-label">{{translate_title('District', $lang)}}</label>
                        <select name="district_id" class="form-control" id="district_id" required>
                            <option value="" disabled selected>{{translate_title('Select district', $lang)}}</option>
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter percent.', $lang)}}
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label class="form-label" id="organization_id">{{translate_title('Organization', $lang)}}</label>
                        <select name="organization_id" class="form-control" id="organization_id" required>
                            <option value="" disabled selected>{{translate_title('Select organization', $lang)}}</option>
                            @foreach($organizations as $organization)
                                <option value="{{$organization['id']}}">{{$organization['name']}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Please select organization.', $lang)}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">{{translate_title('Address', $lang)}}</label>
                        <input type="text" id="address" class="form-control" name="address">
                    </div>
                    <input type="hidden" name="region" id="region">
                    <input type="hidden" name="district" id="district">
                    <div class="width_100_percent d-flex justify-content-between mt-5">
                        <a type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</a>
                        <button type="submit" class="btn modal_confirm">{{translate_title('Create', $lang)}}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div id="carousel-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner" id="carousel_product_images">

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">{{translate_title('Previous', $lang)}}</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">{{translate_title('Next', $lang)}}</span>
                    </a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        let page = false
        let current_region = ''
        let current_district = ''
        if(localStorage.getItem('region_id') != undefined && localStorage.getItem('region_id') != null){
            localStorage.removeItem('region_id')
        }
        if(localStorage.getItem('district_id') != undefined && localStorage.getItem('district_id') != null){
            localStorage.removeItem('district_id')
        }
        if(localStorage.getItem('region') != undefined && localStorage.getItem('region') != null){
            localStorage.removeItem('region')
        }
        if(localStorage.getItem('district') != undefined && localStorage.getItem('district') != null){
            localStorage.removeItem('district')
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
