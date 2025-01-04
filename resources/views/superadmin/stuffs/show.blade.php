@extends('layouts.superadmin_layout')

@section('title')
    {{-- Your page title --}}
@endsection
@section('content')
    <style>
        tr, th, .tablesaw>tbody>tr>td, .tablesaw>tbody>tr, thead{
            border: 0px !important;
        }
    </style>
    <div class="card">
        <div class="card-body">
            <h4 class="mt-0 header-title">{{translate_title('Products lists', $lang)}}</h4>
            <table class="tablesaw table mb-0" data-tablesaw-mode="stack">
                <thead>
                    <tr>
                        <th scope="col">{{translate_title('Attributes', $lang)}}</h6></th>
                        <th scope="col">{{translate_title('Informations', $lang)}}</h6></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><h6>{{translate_title('Name', $lang)}}</h6></th>
                        <td><h6>{{$this_user['name']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Surname', $lang)}}</h6></th>
                        <td><h6>{{$this_user['surname']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Middlename', $lang)}}</h6></th>
                        <td><h6>{{$this_user['middlename']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Phone', $lang)}}</h6></th>
                        <td><h6>{{$this_user['phone']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Old', $lang)}}</h6></th>
                        <td><h6>{{$this_user['old']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Gender', $lang)}}</h6></th>
                        <td><h6>{{$this_user['gender']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Role', $lang)}}</h6></th>
                        <td><h6>{{$this_user['role']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Email', $lang)}}</h6></th>
                        <td><h6>{{$this_user['email']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Status', $lang)}}</h6></th>
                        <td><h6>{{$this_user['status']}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Address', $lang)}}</h6></th>
                        <td><h6>{{$this_user['address']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Passport', $lang)}}</h6></th>
                        <td><h6>{{$this_user['passport']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Company', $lang)}}</h6></th>
                        <td><h6>{{$this_user['company']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Organization', $lang)}}</h6></th>
                        <td><h6>{{$this_user['organization']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('image', $lang)}}</h6></th>
                        <td>
                            <div style="margin-right: 2px">
                                <img onclick="showImage('{{$this_user['image']}}')" src="{{$this_user['image']}}" data-bs-toggle="modal" data-bs-target="#images-modal" alt="" height="144px">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Updated at', $lang)}}</h6></th>
                        <td><h6>{{$this_user['updated_at']??''}}</h6></td>
                    </tr>
                </tbody>
            </table>
        </div>
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
    <style>
        .color_content{
            height: 40px;
            width: 64px;
            border-radius: 4px;
            border: solid 1px;
            display: flex;
            align-items: center;
            justify-content: center
        }
        .dtr-details{
            width: 100% !important;
        }
        table.dataTable.nowrap td
    </style>
@endsection
