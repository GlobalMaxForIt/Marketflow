@extends('layouts.cashier_layout')

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
            <h4 class="mt-0 header-title">{{translate_title('Products lists')}}</h4>
            <table class="tablesaw table mb-0" data-tablesaw-mode="stack">
                <thead>
                    <tr>
                        <th scope="col">{{translate_title('Attributes')}}</th>
                        <th scope="col">{{translate_title('Informations')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{translate_title('Products categories')}}</th>
                        <td>{{$array_product['products_categories']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Name')}}</th>
                        <td>{{$array_product['name']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Amount')}}</th>
                        <td>{{$array_product['amount']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Price')}}</th>
                        <td>{{$array_product['price']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Discount')}}</th>
                        <td>{{$array_product['discount']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Last price')}}</th>
                        <td>{{$array_product['last_price']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Description')}}</th>
                        <td>{{$array_product['description']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Barcode')}}</th>
                        <td>{{$array_product['barcode']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Stock')}}</th>
                        <td>{{$array_product['stock']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Manufactured date')}}</th>
                        <td>{{$array_product['manufactured_date']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Expired date')}}</th>
                        <td>{{$array_product['expired_date']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Status')}}</th>
                        <td>{{$array_product['status'] == 1?translate_title('Active'):translate_title('No active') }}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Store')}}</th>
                        <td>{{$array_product['store']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Company')}}</th>
                        <td>{{$array_product['company']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('Unit')}}</th>
                        <td>{{$array_product['unit']??''}}</td>
                    </tr>
                    <tr>
                        <th>{{translate_title('image')}}</th>
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
                        <th>{{translate_title('Updated at')}}</th>
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
