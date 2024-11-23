@extends('layouts.admin_layout')

@section('title')
    {{translate_title('Edit client')}}
@endsection
@section('content')
    <div class="main-content-section">
        <div class="order-section">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt-0 header-title">{{translate_title('Edit client')}}</h4>
                </div>
                <div class="card-body">
                    <form class="modal-body needs-validation" action="{{route('clients.update', $client->id)}}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="position-relative col-6 mb-3">
                                <label for="name" class="form-label">{{translate_title('Name')}}</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{$client->name}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter name.')}}
                                </div>
                            </div>
                            <div class="position-relative col-6 mb-3">
                                <label for="surname" class="form-label">{{translate_title('Surname')}}</label>
                                <input type="text" id="surname" class="form-control" name="surname" value="{{$client->surname}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter surname.')}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="middlename" class="form-label">{{translate_title('Middlename')}}</label>
                                <input type="text" id="middlename" class="form-control" name="middlename"  value="{{$client->middlename}}">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="phone" class="form-label">{{translate_title('Phone')}}</label>
                                <input type="text" id="phone" class="form-control" name="phone" value="{{$client->phone}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <img src="{{asset("storage/clients/$client->image")}}" alt="" height="144px">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="name" class="form-label">{{translate_title('Image')}}</label>
                                <input type="file" id="image" class="form-control" name="image">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="email" class="form-label">{{translate_title('Email')}}</label>
                                <input type="text" id="email" class="form-control" name="email" value="{{$client->email}}">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="male">Male</label>
                                <input type="radio" name="gender" id="male" value="{{\App\Constants::MALE}}" {{$client->gender == \App\Constants::MALE?'checked':''}} class="me-4">
                                <label for="female">Female</label>
                                <input type="radio" name="gender" id="female" value="{{\App\Constants::FEMALE}}" {{$client->gender == \App\Constants::FEMALE?'checked':''}}>
                            </div>
                        </div>
                        <div class="row">
                            <div class="position-relative col-6 mb-3">
                                <label class="form-label">{{translate_title('Region')}}</label>
                                <select name="region_id" class="form-control" id="region_id" required>
                                    <option value="" disabled selected>{{translate_title('Select region')}}</option>
                                </select>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please select region.')}}
                                </div>
                            </div>
                            <div class="position-relative col-6 mb-3">
                                <label class="form-label">{{translate_title('District')}}</label>
                                <select name="district_id" class="form-control" id="district_id" required>
                                    <option value="" disabled selected>{{translate_title('Select district')}}</option>
                                </select>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please select district.')}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="address" class="form-label">{{translate_title('Address')}}</label>
                                <input type="text" id="address" class="form-control" name="address" value="{{$client->address?$client->address->name:''}}">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="notes" class="form-label">{{translate_title('Notes')}}</label>
                                <input type="text" id="notes" class="form-control" name="notes" value="{{$client->notes}}">
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
    <script>
        let page = true
        @if($client->address)
            @if($client->address->cities)
                let current_region = "{{$client->address->cities->region?$client->address->cities->region->id:''}}"
                let current_district = "{{$client->address->cities->id??''}}"
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
