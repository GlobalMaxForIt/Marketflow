@extends('layouts.superadmin_layout')

@section('content')
    <style>
        .common_statistics{
            height: 210px
        }
        .common_statistics >.card-body{
            padding: 30px;
        }
        .stuffs_menu{
            height: 150px;
        }
        .col-xl-4 .card{
            height: 100%;
        }
        .card-body .widget-chart{
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }
    </style>
    <div class="container-fluid">
        <div class="row" style="margin-bottom: 26px">
            <div class="col-xl-3 col-md-6">
                <div class="card common_statistics">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-4">{{translate_title('Orders status ordered', $lang)}}</h4>
                        <div>
                            <h1>{{$ordered_orders}}</h1>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card common_statistics">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-4">{{translate_title('Orders status performed', $lang)}}</h4>
                        <div>
                            <h1>{{$performed_orders}}</h1>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->


            <div class="col-xl-3 col-md-6">
                <div class="card common_statistics">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-4">{{translate_title('Orders status cancelled', $lang)}}</h4>
                        <div>
                            <h1>{{$cancelled_orders}}</h1>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card common_statistics">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-4">{{translate_title('Orders status accepted', $lang)}}</h4>
                        <div>
                            <h1>{{$accepted_orders}}</h1>
                        </div>
                    </div>
                </div>

            </div><!-- end col -->
        </div>
        <!-- end row -->

        <div class="row" style="margin-bottom: 26px">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0">{{translate_title('Orders by status', $lang)}}</h4>
                        <div class="widget-chart text-center">
                            <div id="morris-donut-example" dir="ltr" style="height: 245px;" class="morris-chart"></div>
                            <ul class="list-inline chart-detail-list mb-0">
                                <li class="list-inline-item">
                                    <h5 style="color: #FF6C37;"><i class="fa fa-circle me-1"></i>{{translate_title('Orders active', $lang)}}</h5>
                                </li>
                                <li class="list-inline-item">
                                    <h5 style="color: #10C469;"><i class="fa fa-circle me-1"></i>{{translate_title('Orders performed', $lang)}}</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->


            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0">{{translate_title('Orders by status', $lang)}}</h4>
                        <div class="widget-chart text-center">
                            <div id="morris-donut-example-1" dir="ltr" style="height: 245px;" class="morris-chart"></div>
                            <ul class="list-inline chart-detail-list mb-0">
                                <li class="list-inline-item">
                                    <h5 style="color: #FF6C37;"><i class="fa fa-circle me-1"></i>{{translate_title('Orders active', $lang)}}</h5>
                                </li>
                                <li class="list-inline-item">
                                    <h5 style="color: #10C469;"><i class="fa fa-circle me-1"></i>{{translate_title('Orders performed', $lang)}}</h5>
                                </li>
                            </ul>
                            <ul class="list-inline chart-detail-list mb-0">
                                <li class="list-inline-item">
                                    <h5 style="color: #00ADD7;"><i class="fa fa-circle me-1"></i>{{translate_title('Completed orders', $lang)}}</h5>
                                </li>
                                <li class="list-inline-item">
                                    <h5 style="color: #FF0000;"><i class="fa fa-circle me-1"></i>{{translate_title('Cancelled orders')}}</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0">{{translate_title('Orders by status', $lang)}}</h4>
                        <div class="widget-chart text-center">
                            <div id="morris-donut-example-2" dir="ltr" style="height: 245px;" class="morris-chart"></div>
                            <ul class="list-inline chart-detail-list mb-0">
                                <li class="list-inline-item">
                                    <h5 style="color: #00ADD7;"><i class="fa fa-circle me-1"></i>{{translate_title('Completed orders', $lang)}}</h5>
                                </li>
                                <li class="list-inline-item">
                                    <h5 style="color: #FF0000;"><i class="fa fa-circle me-1"></i>{{translate_title('Cancelled orders', $lang)}}</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div>
@endsection
