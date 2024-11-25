@extends('layouts.superadmin_layout')

@section('title')
    {{translate_title('Employees')}}
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
                                <a class="form_functions global-button" data-bs-toggle="modal" data-bs-target="#create_modal" data-url="{{route('companies.store')}}">
                                    <span class="mdi mdi-basket-unfill font-20"></span>
                                    {{translate_title('New company')}}
                                </a>
                            </div>
                            <div class="card-body overflow-auto">
                                <table id="datatable-buttons" class="restaurant_tables table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>{{translate_title('Id')}}</th>
                                            <th>{{translate_title('Name')}}</th>
                                            <th>{{translate_title('Address')}}</th>
                                            <th>{{translate_title('Images')}}</th>
                                            <th>{{translate_title('Functions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($companies as $company)
                                        <tr>
                                            <td class="show_page">{{$company['id']}}</td>
                                            <td>{{$company['name']}}</td>
                                            <td>{{$company['address']}}</td>
                                            <td>
                                                <a class="product_images_column" onclick='getImages("{{implode(" ", $company['images'])}}")' data-bs-toggle="modal" data-bs-target="#carousel-modal">
                                                    @foreach($company['images'] as $image)
                                                        <div style="margin-right: 2px">
                                                            <img src="{{$image}}" alt="" height="50px">
                                                        </div>
                                                    @endforeach
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-around align-items-center height_50 function_buttons">
                                                    <a class="edit_button btn me-2" href="{{route('companies.edit', $company['id'])}}">
                                                        <img src="{{asset('img/edit_icon.png')}}" alt="" height="18px">
                                                    </a>
                                                    <a type="button" class="btn delete_button btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('companies.destroy', $company['id'])}}">
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
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('New company')}}</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <form class="modal-body needs-validation" action="{{route('companies.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('POST')
                    <div class="position-relative mb-3">
                        <label for="name" class="form-label">{{translate_title('Name')}}</label>
                        <input type="text" id="name" class="form-control" name="name" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter stuff category.')}}
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
                    <div class="position-relative mb-3">
                        <label class="form-label">{{translate_title('Region')}}</label>
                        <select name="region_id" class="form-control" id="region_id" required>
                            <option value="" disabled selected>{{translate_title('Select region')}}</option>
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter percent.')}}
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label class="form-label">{{translate_title('District')}}</label>
                        <select name="district_id" class="form-control" id="district_id" required>
                            <option value="" disabled selected>{{translate_title('Select district')}}</option>
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter percent.')}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">{{translate_title('Address')}}</label>
                        <input type="text" id="address" class="form-control" name="address">
                    </div>
                    <input type="hidden" name="region" id="region">
                    <input type="hidden" name="district" id="district">
                    <div class="width_100_percent d-flex justify-content-between mt-5">
                        <a type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close')}}</a>
                        <a type="submit" class="btn modal_confirm">{{translate_title('Create')}}</a>
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
