@extends('layouts.superadmin_layout')

@section('title')
    {{translate_title('Edit employee', $lang)}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt-0 header-title">{{translate_title('Edit employee', $lang)}}</h4>
                </div>
                <div class="card-body">
                    <form class="modal-body needs-validation" action="{{route('users.update', $user['id'])}}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="position-relative col-6 mb-3">
                                <label for="name" class="form-label">{{translate_title('Name', $lang)}}</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{$user['name']}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter percent.', $lang)}}
                                </div>
                            </div>
                            <div class="position-relative col-6 mb-3">
                                <label for="surname" class="form-label">{{translate_title('Surname', $lang)}}</label>
                                <input type="text" id="surname" class="form-control" name="surname" value="{{$user['surname']}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter percent.', $lang)}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="middlename" class="form-label">{{translate_title('Middlename', $lang)}}</label>
                                <input type="text" id="middlename" class="form-control" name="middlename"  value="{{$user['middlename']}}">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="phone" class="form-label">{{translate_title('Phone', $lang)}}</label>
                                <input type="text" id="phone" class="form-control" name="phone" value="{{$user['phone']}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <img onclick="showImage('{{$user['image']?asset("storage/users/".$user['image']):asset('icon/no_photo.jpg')}}')" data-bs-toggle="modal" data-bs-target="#images-modal" src="{{$user['image']?asset("storage/users/".$user['image']):asset('icon/no_photo.jpg')}}" alt="" height="144px">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="name" class="form-label">{{translate_title('Image', $lang)}}</label>
                                <input type="file" id="image" class="form-control" name="image">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="email" class="form-label">{{translate_title('Email', $lang)}}</label>
                                <input type="text" id="email" class="form-control" name="email" value="{{$user['email']}}">
                            </div>
                            <div class="col-4 mb-3 d-flex align-items-center">
                                <label for="male" class="me-2 form-check-label">{{translate_title('Male', $lang)}}</label>
                                <input type="radio" name="gender" id="male" value="{{\App\Constants::MALE}}" {{$user['gender'] == \App\Constants::MALE?'checked':''}} class="me-4 form-check-input">
                                <label for="female" class="me-2 form-check-label">{{translate_title('Female', $lang)}}</label>
                                <input type="radio" name="gender" id="female" class="form-check-input" value="{{\App\Constants::FEMALE}}" {{$user['gender'] == \App\Constants::FEMALE?'checked':''}}>
                            </div>
                            <div class="col-2 mb-3 d-flex align-items-center">
                                <label class="form-check-label me-2" for="status_">{{translate_title('Status', $lang)}}</label>
                                <input class="form-check-input rounded-circle" type="checkbox" name="status" id="status_" {{(int)$user['status'] == 0?'checked':''}}>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-4">
                                <label for="birth_date" class="form-label" for="status_">{{translate_title('Birth date', $lang)}}</label>
                                <input type="text" name="birth_date" id="basic-datepicker" class="form-control" placeholder="Birth date" value="{{$user['birth_date']}}">
                            </div>
                            <div class="mb-3 col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="passport">{{translate_title('Passport', $lang)}}</label>
                                    <input type="text" name="passport" id="passport" class="form-control" placeholder="AA1234567">
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
                            <div class="col-6 mb-3">
                                <label for="address" class="form-label">{{translate_title('Address', $lang)}}</label>
                                <input type="text" id="address" class="form-control" name="address" value="{{$user->address?$user->address->name:''}}">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="password" class="form-label">{{translate_title('Current password', $lang)}}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" placeholder="Enter current password" name="password">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 mb-3">
                                <label for="new_password" class="form-label">{{translate_title('Password', $lang)}}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="new_password" class="form-control" placeholder="Enter new password" name="new_password">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <label for="password_confirm" class="form-label">{{translate_title('Password confirmation', $lang)}}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirm" class="form-control" placeholder="Confirm password" name="password_confirmation">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="role" id="floatingSelect" aria-label="Floating label select example">
                                        @foreach($roles as $role)
                                            <option value="{{$role['value']}}" {{$user['role'] == $role['value']?'selected':''}}>{{$role['name']}}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect">{{translate_title('Role', $lang)}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3 d-none position-relative" id="company_content">
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
                            <div class="col-6 position-relative mb-3 d-none" id="organization_content">
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
                            <div class="col-6 position-relative mb-3 d-none" id="store_content">
                                <label for="store" class="form-label">{{translate_title('Store', $lang)}}</label>
                                <select name="store" class="form-control" id="store">
                                    <option value="" disabled selected>{{translate_title('Select store', $lang)}}</option>
                                </select>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please select store.', $lang)}}
                                </div>
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
        @if($user->address)
            @if($user->address->cities)
                let current_region = "{{$user->address->cities->region?$user->address->cities->region->id:''}}"
                let current_district = "{{$user->address->cities->id??''}}"
            @else
                let current_region = ''
                let current_district = ''
            @endif
        @else
            let current_region = ''
            let current_district = ''
        @endif
    </script>
    <script src="{{asset('js/cities.js')}}"></script>
@endsection
