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
                                <a class="form_functions global-button" data-bs-toggle="modal" data-bs-target="#create_modal" data-url="{{route('users.store')}}">
                                    <img src="{{asset('menubar/employee_active.png')}}" alt="" height="20px">
                                    {{translate_title('Новый Сотрудник', $lang)}}
                                </a>
                            </div>
                            <div class="card-body overflow-auto">
{{--                                <table id="datatable-buttons" class="restaurant_tables table table-striped table-bordered dt-responsive nowrap">--}}
                                <table id="datatable-buttons" class="restaurant_tables table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th><h6>{{translate_title('Id', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Name', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Surname', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Image', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Old', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Role', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Status', $lang)}}</h6></th>
                                            <th><h6>{{translate_title('Functions', $lang)}}</h6></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="show_page">{{$user['id']}}</h6></td>
                                            <td><h6>{{$user['name']}}</h6></td>
                                            <td><h6>{{$user['surname']}}</h6></td>
                                            <td>
                                                <img onclick="showImage('{{$user['image']?asset("storage/users/".$user['image']):asset('icon/no_photo.jpg')}}')" data-bs-toggle="modal" data-bs-target="#images-modal" src="{{$user['image']?asset("storage/users/".$user['image']):asset('icon/no_photo.jpg')}}" alt="" height="50px">
                                            </td>
                                            <td><h6>{{$user['old']}}</h6></td>
                                            <td><h6>{{$user['role']}}</h6></td>
                                            <td><h6>{{$user['status']}}</h6></td>
                                            <td>
                                                <div class="d-flex justify-content-around align-items-center height_50 function_buttons">
                                                    <a class="edit_button btn me-2" href="{{route('users.edit', $user['id'])}}">
                                                        <img src="{{asset('img/edit_icon.png')}}" alt="" height="18px">
                                                    </a>
                                                    <a class="edit_button btn me-2" data-bs-toggle="modal" data-bs-target="#full_info_modal" onclick="showFullInfo(
                                                        '{{$user['id']}}',
                                                        '{{$user['name']}}',
                                                        '{{$user['surname']}}',
                                                        '{{$user['middlename']}}',
                                                        '{{$user['phone']}}',
                                                        '{{$user['image']?asset("storage/users/".$user['image']):asset('icon/no_photo.jpg')}}',
                                                        '{{$user['email']}}',
                                                        '{{$user['old']}}',
                                                        '{{$user['gender']}}',
                                                        '{{$user['role']}}',
                                                        '{{$user['status']}}',
                                                        @if($user['address'])
                                                        '{{$user['address']->name??''}}',
                                                        @else
                                                        '',
                                                        @endif
                                                        '{{$user['company']}}',
                                                        '{{$user['organization']}}',
                                                        '{{$user['passport']}}')">
                                                        <span class="fa fa-eye height_18"></span>
                                                    </a>
                                                    <a type="button" class="btn delete_button btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('users.destroy', $user['id'])}}">
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
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('New user', $lang)}}</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <form class="modal-body needs-validation" action="{{route('users.store')}}" method="POST" enctype="multipart/form-data" novalidate>
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
                        <input type="email" id="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="male">{{translate_title('Male', $lang)}}</label>
                        <input type="radio" name="gender" id="male" value="{{\App\Constants::MALE}}" checked class="me-4">
                        <label for="female">{{translate_title('Female', $lang)}}</label>
                        <input type="radio" name="gender" id="female" value="{{\App\Constants::FEMALE}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="status_">{{translate_title('Status', $lang)}}</label>
                        <input type="checkbox" name="status" id="status_">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="status_">{{translate_title('Birth date', $lang)}}</label>
                        <input type="text" name="birth_date" id="basic-datepicker" class="form-control" placeholder="Birth date">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="passport">{{translate_title('Passport', $lang)}}</label>
                        <input type="text" name="passport" id="passport" class="form-control" placeholder="AA1234567">
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
                        <label for="new_password" class="form-label">{{translate_title('Password', $lang)}}</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="new_password" class="form-control" placeholder="Enter new password" name="new_password" required>
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye"></span>
                            </div>
                            <div class="invalid-tooltip">
                                {{translate_title('Please enter password.', $lang)}}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirm" class="form-label">{{translate_title('Password confirmation', $lang)}}</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password_confirm" class="form-control" placeholder="Confirm password" name="password_confirmation" required>
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye"></span>
                            </div>
                            <div class="invalid-tooltip">
                                {{translate_title('Please enter password confirmation.', $lang)}}
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="role" id="floatingSelect" aria-label="Floating label select example">
                            @foreach($roles as $role)
                                <option value="{{$role['value']}}">{{$role['name']}}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">{{translate_title('Role', $lang)}}</label>
                    </div>
                    <div class="mb-3 d-none position-relative" id="company_content">
                        <label for="company" class="form-label">{{translate_title('Company', $lang)}}</label>
                        <select name="company" class="form-control" id="company">
                            <option value="" disabled selected>{{translate_title('Select company', $lang)}}</option>
                            @foreach($companies as $company)
                                <option value="{{$company['id']}}">{{$company['name']}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Please select company.', $lang)}}
                        </div>
                    </div>
                    <div class="position-relative mb-3 d-none" id="organization_content">
                        <label for="organization" class="form-label">{{translate_title('Organization', $lang)}}</label>
                        <select name="organization" class="form-control" id="organization">
                            <option value="" disabled selected>{{translate_title('Select Organization', $lang)}}</option>
                            @foreach($organizations as $organization)
                                <option value="{{$organization['id']}}">{{$organization['name']}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Please select organization.', $lang)}}
                        </div>
                    </div>
                    <div class="position-relative mb-3 d-none" id="store_content">
                        <label for="store" class="form-label">{{translate_title('Store', $lang)}}</label>
                        <select name="store" class="form-control" id="store">
                            <option value="" disabled selected>{{translate_title('Select store', $lang)}}</option>
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Please select store.', $lang)}}
                        </div>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="full_info_modal"
         aria-labelledby="scrollableModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('Stuff full info', $lang)}}</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <table class="tablesaw">
                        <thead>
                            <tr>
                                <th scope="col">
                                    Title
                                </th>
                                <th scope="col"
                                    data-tablesaw-priority="3">value
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><h6>{{translate_title('id', $lang)}}</h6></td>
                                <td id="user_info_id"></td>
                            </tr>
                            <tr>
                                <td><h6>{{translate_title('name', $lang)}}</h6></td>
                                <td id="user_info_name"></td>
                            </tr>
                            <tr>
                                <td><h6>{{translate_title('surname', $lang)}}</h6></td>
                                <td id="user_info_surname"></td>
                            </tr>
                            <tr>
                                <td><h6>{{translate_title('middlename', $lang)}}</h6></td>
                                <td id="user_info_middlename"></td>
                            </tr>
                            <tr>
                                <td><h6>{{translate_title('phone', $lang)}}</h6></td>
                                <td id="user_info_phone"></td>
                            </tr>
                            <tr>
                                <td><h6>{{translate_title('image', $lang)}}</h6></td>
                                <td id="user_info_image"></td>
                            </tr>
                            <tr>
                                <td><h6>{{translate_title('email', $lang)}}</h6></td>
                                <td id="user_info_email"></td>
                            </tr>
                            <tr>
                                <td><h6>{{translate_title('old', $lang)}}</h6></td>
                                <td id="user_info_old"></td>
                            </tr>
                            <tr>
                                <td><h6>{{translate_title('gender', $lang)}}</h6></td>
                                <td id="user_info_gender"></td>
                            </tr>
                            <tr>
                                <td><h6>{{translate_title('role', $lang)}}</h6></td>
                                <td id="user_info_role"></td>
                            </tr>
                            <tr>
                                <td><h6>{{translate_title('passport', $lang)}}</h6></td>
                                <td id="user_info_passport"></td>
                            </tr>
                            <tr>
                                <td><h6>{{translate_title('status', $lang)}}</h6></td>
                                <td id="user_info_status"></td>
                            </tr>
                            <tr>
                                <td><h6>{{translate_title('address', $lang)}}</h6></td>
                                <td id="user_info_address"></td>
                            </tr>
                            <tr>
                                <td><h6>{{translate_title('company', $lang)}}</h6></td>
                                <td id="user_info_company"></td>
                            </tr>
                            <tr>
                                <td><h6>{{translate_title('organization', $lang)}}</h6></td>
                                <td id="user_info_organization"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <script src="{{asset('js/stuffs.js')}}"></script>
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
        let user_info_id = document.getElementById('user_info_id')
        let user_info_name = document.getElementById('user_info_name')
        let user_info_surname = document.getElementById('user_info_surname')
        let user_info_middlename = document.getElementById('user_info_middlename')
        let user_info_phone = document.getElementById('user_info_phone')
        let user_info_image = document.getElementById('user_info_image')
        let user_info_email = document.getElementById('user_info_email')
        let user_info_old = document.getElementById('user_info_old')
        let user_info_gender = document.getElementById('user_info_gender')
        let user_info_role = document.getElementById('user_info_role')
        let user_info_status = document.getElementById('user_info_status')
        let user_info_address = document.getElementById('user_info_address')
        let user_info_company = document.getElementById('user_info_company')
        let user_info_organization = document.getElementById('user_info_organization')
        let user_info_passport = document.getElementById('user_info_passport')
        function showFullInfo(this_id, this_name, this_surname, this_middlename, this_phone, this_image, this_email, this_old, this_gender, this_role, this_status, this_address, this_company, this_organization, this_passport) {
            user_info_id.innerText = this_id
            user_info_name.innerText = this_name
            user_info_surname.innerText = this_surname
            user_info_middlename.innerText = this_middlename
            user_info_phone.innerText = this_phone
            user_info_image.innerText = this_image
            user_info_image.innerHTML = `<img src="${this_image}" alt="" height="64px">`
            user_info_email.innerText = this_email
            user_info_old.innerText = this_old
            user_info_gender.innerText = this_gender
            user_info_role.innerText = this_role
            user_info_status.innerText = this_status
            user_info_address.innerText = this_address
            user_info_company.innerText = this_company
            user_info_organization.innerText = this_organization
            user_info_passport.innerText = this_passport
        }
    </script>
    <script src="{{asset('js/cities.js')}}"></script>
@endsection
