@extends('layouts.admin_layout')

@section('title')
     {{translate_title('Clients')}}
@endsection
@section('content')
    <div id="loader"></div>
    <div class="main-content-section d-none" id="myDiv">
        <div class="order-section">
            <div class="card">
                <div class="right_button_create">
                    <a class="form_functions global-button" data-bs-toggle="modal" data-bs-target="#create_modal" data-url="{{route('clients.store')}}">
                        <img src="{{asset('img/client_icon.png')}}" alt="" height="20px">
                        {{translate_title('Новый клиент', $lang)}}
                    </a>
                </div>
                <div class="card-body overflow-auto">
                    <table id="datatable-buttons" class="restaurant_tables table table-striped table-bordered dt-responsive nowrap mt-4">
                        <thead>
                            <tr>
                                <th>{{translate_title('Id', $lang)}}</th>
                                <th>{{translate_title('Name', $lang)}}</th>
                                <th>{{translate_title('Surname', $lang)}}</th>
                                <th>{{translate_title('Middlename', $lang)}}</th>
                                <th>{{translate_title('Phone', $lang)}}</th>
                                <th>{{translate_title('Image', $lang)}}</th>
                                <th>{{translate_title('Email', $lang)}}</th>
                                <th>{{translate_title('Gender', $lang)}}</th>
                                <th>{{translate_title('Address', $lang)}}</th>
                                <th>{{translate_title('Notes', $lang)}}</th>
                                <th>{{translate_title('Functions', $lang)}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$client['id']}}</td>
                                    <td>{{$client['name']}}</td>
                                    <td>{{$client['surname']}}</td>
                                    <td>{{$client['middlename']}}</td>
                                    <td>{{$client['phone']}}</td>
                                    <td>
                                        <img onclick="showImage('{{$client['image']}}')" data-bs-toggle="modal" data-bs-target="#images-modal" src="{{$client['image']}}" alt="" height="50px">
                                    </td>
                                    <td>{{$client['email']}}</td>
                                    <td>
                                        @if($client['gender'] == \App\Constants::MALE)
                                            {{translate_title('Male', $lang)}}
                                        @elseif($client['gender'] == \App\Constants::FEMALE)
                                            {{translate_title('Female', $lang)}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($client['address'])
                                            {{$client['address']->name??''}}
                                        @endif
                                    </td>
                                    <td>{{$client['notes']}}</td>
                                    <td>
                                        <div class="d-flex justify-content-around align-items-center height_50 function_buttons">
                                            <a class="edit_button btn" href="{{route('clients.edit', $client['id'])}}">
                                                <img src="{{asset('img/edit_icon.png')}}" alt="" height="18px">
                                            </a>
                                            <a type="button" class="btn delete_button btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('clients.destroy', $client['id'])}}">
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
    <div class="modal fade" tabindex="-1" role="dialog" id="create_modal"
         aria-labelledby="scrollableModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('Новый клиент', $lang)}}</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <form class="modal-body needs-validation" action="{{route('clients.store', $lang)}}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('POST')
                    <div class="position-relative mb-3">
                        <label for="name" class="form-label">{{translate_title('Name', $lang)}}</label>
                        <input type="text" id="name" class="form-control" name="name" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter name.', $lang)}}
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label for="surname" class="form-label">{{translate_title('Surname', $lang)}}</label>
                        <input type="text" id="surname" class="form-control" name="surname" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter surname.', $lang)}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="middlename" class="form-label">{{translate_title('Middlename', $lang)}}</label>
                        <input type="text" id="middlename" class="form-control" name="middlename">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">{{translate_title('Phone', $lang)}}</label>
                        <input type="text" id="phone" class="form-control" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="image_input" class="form-label">{{translate_title('Image', $lang)}}</label>
                        <div class="d-flex">
                            <div class="default_image_content">
                                <img src="{{asset('img/default_image_plus.png')}}" alt="">
                            </div>
                            <span class="ms-1" id="images_quantity"></span>
                        </div>
                        <input type="file" id="image_input" name="image" class="form-control d-none">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{translate_title('Email', $lang)}}</label>
                        <input type="text" id="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="male">{{translate_title('Male', $lang)}}</label>
                        <input type="radio" name="gender" id="male" value="{{\App\Constants::MALE}}" checked class="me-4">
                        <label for="female">{{translate_title('Female', $lang)}}</label>
                        <input type="radio" name="gender" id="female" value="{{\App\Constants::FEMALE}}">
                    </div>
                    <div class="position-relative mb-3">
                        <label class="form-label">{{translate_title('Region', $lang)}}</label>
                        <select name="region_id" class="form-control" id="region_id" required>
                            <option value="" disabled selected>{{translate_title('Select region', $lang)}}</option>
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Please select region.', $lang)}}
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label class="form-label">{{translate_title('District', $lang)}}</label>
                        <select name="district_id" class="form-control" id="district_id" required>
                            <option value="" disabled selected>{{translate_title('Select district', $lang)}}</option>
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Please select district.', $lang)}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">{{translate_title('Address', $lang)}}</label>
                        <input type="text" id="address" class="form-control" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">{{translate_title('Notes', $lang)}}</label>
                        <input type="text" id="notes" class="form-control" name="notes">
                    </div>
                    <input type="hidden" name="region" id="region">
                    <input type="hidden" name="district" id="district">
                    <div class="d-flex justify-content-between width_100_percent">
                        <a type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</a>
                        <button type="submit" class="btn modal_confirm">{{translate_title('Create', $lang)}}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
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
    <script src="{{asset('js/datatables_style.js')}}"></script>
@endsection
