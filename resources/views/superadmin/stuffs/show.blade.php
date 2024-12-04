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
                        <th scope="col">{{translate_title('Attributes', $lang)}}</th>
                        <th scope="col">{{translate_title('Informations', $lang)}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{translate_title('Name', $lang)}}</th>
                        <td>{{$user['name']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Surname', $lang)}}</th>
                        <td>{{$user['surname']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Middlename', $lang)}}</th>
                        <td>{{$user['middlename']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Phone', $lang)}}</th>
                        <td>{{$user['phone']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Old', $lang)}}</th>
                        <td>{{$user['old']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Gender', $lang)}}</th>
                        <td>{{$user['gender']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Role', $lang)}}</th>
                        <td>{{$user['role']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Email', $lang)}}</th>
                        <td>{{$user['email']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Status', $lang)}}</th>
                        <td>{{$user['status']}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Address', $lang)}}</th>
                        <td>{{$user['address']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Passport', $lang)}}</th>
                        <td>{{$user['passport']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Company', $lang)}}</th>
                        <td>{{$user['company']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Organization', $lang)}}</th>
                        <td>{{$user['organization']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('image', $lang)}}</th>
                        <td>
                            <div style="margin-right: 2px">
                                <img onclick="showImage('{{$user['image']}}')" src="{{$user['image']}}" data-bs-toggle="modal" data-bs-target="#images-modal" alt="" height="144px">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Updated at', $lang)}}</th>
                        <td>{{$user['updated_at']??''}}</td>
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
