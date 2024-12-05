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
                        <th><h6>{{translate_title('Products categories', $lang)}}</h6></th>
                        <td><h6>{{$array_product['products_categories']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Name', $lang)}}</h6></th>
                        <td><h6>{{$array_product['name']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Amount', $lang)}}</h6></th>
                        <td><h6>{{$array_product['amount']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Price', $lang)}}</h6></th>
                        <td><h6>{{$array_product['price']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Discount', $lang)}}</h6></th>
                        <td><h6>{{$array_product['discount']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Last price', $lang)}}</h6></th>
                        <td><h6>{{$array_product['last_price']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Description', $lang)}}</h6></th>
                        <td><h6>{{$array_product['description']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Barcode', $lang)}}</h6></th>
                        <td><h6>{{$array_product['barcode']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Stock', $lang)}}</h6></th>
                        <td><h6>{{$array_product['stock']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Manufactured date', $lang)}}</h6></th>
                        <td><h6>{{$array_product['manufactured_date']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Fast selling good', $lang)}}</h6></th>
                        <td><h6>{{$array_product['fast_selling_goods']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Expired date', $lang)}}</h6></th>
                        <td><h6>{{$array_product['expired_date']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Status', $lang)}}</h6></th>
                        <td><h6>{{$array_product['status'] == 1?translate_title('Active', $lang):translate_title('No active', $lang) }}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Store', $lang)}}</h6></th>
                        <td><h6>{{$array_product['store']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Company', $lang)}}</h6></th>
                        <td><h6>{{$array_product['company']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Unit', $lang)}}</h6></th>
                        <td><h6>{{$array_product['unit']??''}}</h6></td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('image', $lang)}}</h6></th>
                        <td>
                            <a class="productImages_column" onclick='getImages("{{implode(" ", $array_product['images'])}}")' data-bs-toggle="modal" data-bs-target="#carousel-modal">
                                @foreach($array_product['images'] as $image)
                                    <div style="margin-right: 2px">
                                        <img src="{{$image}}" alt="" height="144px">
                                    </div>
                                @endforeach
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Small image', $lang)}}</h6></th>
                        <td>
                            <img onclick="showImage('{{$array_product['small_image']}}')" data-bs-toggle="modal" data-bs-target="#images-modal" src="{{$array_product['small_image']}}" alt="" height="144px">
                        </td>
                    </tr>
                    <tr>
                        <th><h6>{{translate_title('Updated at', $lang)}}</h6></th>
                        <td><h6>{{$array_product['updated_at']??''}}</h6></td>
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
