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
                        <th>{{translate_title('Products categories', $lang)}}</th>
                        <td>{{$array_product['products_categories']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Name', $lang)}}</th>
                        <td>{{$array_product['name']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Amount', $lang)}}</th>
                        <td>{{$array_product['amount']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Price', $lang)}}</th>
                        <td>{{$array_product['price']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Discount', $lang)}}</th>
                        <td>{{$array_product['discount']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Last price', $lang)}}</th>
                        <td>{{$array_product['last_price']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Description', $lang)}}</th>
                        <td>{{$array_product['description']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Barcode', $lang)}}</th>
                        <td>{{$array_product['barcode']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Stock', $lang)}}</th>
                        <td>{{$array_product['stock']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Manufactured date', $lang)}}</th>
                        <td>{{$array_product['manufactured_date']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Expired date', $lang)}}</th>
                        <td>{{$array_product['expired_date']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Status', $lang)}}</th>
                        <td>{{$array_product['status'] == 1?translate_title('Active', $lang):translate_title('No active', $lang) }}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Store', $lang)}}</th>
                        <td>{{$array_product['store']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Company', $lang)}}</th>
                        <td>{{$array_product['company']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Unit', $lang)}}</th>
                        <td>{{$array_product['unit']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('image', $lang)}}</th>
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
                        <th>{{translate_title('Updated at', $lang)}}</th>
                        <td>{{$array_product['updated_at']??''}}</td>
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
