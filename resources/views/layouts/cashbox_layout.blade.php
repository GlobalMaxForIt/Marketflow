@php
    $current_user = \Illuminate\Support\Facades\Auth::user();
    $locale = app()->getLocale();

@endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="{{ asset('libs/toastr/build/toastr.min.css') }}" type="text/css" rel="stylesheet"/>
    <!-- third party css -->

    <link href="{{ asset('libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('libs/tablesaw/tablesaw.css')}}">
    <link href="{{ asset('libs/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
    <!-- App css -->
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style"/>
    {{-- Main css --}}
    <link href="{{ asset('libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- icons -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/font/font.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/basket.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/main_manage.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatable_style.css')}}">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/toastr/build/toastr.min.js') }}"></script>

    <style>
        #loader{
            left: 54% !important;
        }
        .img-thumbnail{
            height: 56px;
        }
        .content-page{
            margin-left: 0px !important;
        }
        #wrapper{
            font-size: 12px !important;
        }
        .container-fluid, .col-3, .col-5, .col-4, .col-sm-12, .col-12{
            padding: 0px !important;
        }
        #dragTree>ul{
            padding: 0px !important;
        }
        .dataTables_filter input{
            padding-left: 40px;
            border: solid 1px;
        }
        .dataTables_filter div{
            margin: -38px 0px 0px 14px;
        }
        table th{
            padding: 0px 14px!important;
        }
        .order-section{
            padding: 8px;
        }
        .card{
            min-height: 100vh;
        }
        table{
            border-color: transparent !important;
        }
        .btn-number {
            font-size: 2rem;
            min-width: 50px;
            width: 84% !important;
        }
        .btn-number-password {
            font-size: 2rem;
            min-width: 50px;
            width: 94% !important;
        }
        .input-display {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 10px;
            width: 95%;
        }
        .input-display_ {
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 10px;
            width: 95%;
        }
        .input-display_ {
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 10px;
            width: 95%;
        }
        .input-display_password {
            font-size: 20px;
            margin-bottom: 20px;
            text-align: center;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 10px;
            width: 98%;
        }
        #change_cashier select{
            width: 98%;
        }

        .cash_calculator{
            max-width: 440px;
            width: 45%;
        }
        .modal_close{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .navbar-custom ul, .navbar-custom ul li{
            height: 100%;
        }
        .navbar-custom ul li{
            display: flex;
            align-items: center;
        }
        .topnav-menu li{
            margin-left: 14px;
        }
        .btn-outline-secondary{
            width: 30%;
            height: 50px;
            border-radius: 10px;
            border: solid 1px #ccc;
        }
    </style>
</head>

<body class="loading" data-layout-color="light" data-layout-mode="default" data-layout-size="fluid" id="body_layout"
      data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default'
      data-sidebar-user='true'>

<div id="loader"></div>
<div class="background_transparent display-none"></div>
<div class="background_opacity" id="myDiv"></div>

<!-- Begin page -->

<div id="wrapper">
    <div id="clear_all_notifications" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                            <i class="dripicons-warning h1 text-warning"></i>
                            <h4 class="mt-2">{{ translate_title('Are you sure you want to make all notifications as read')}}</h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{--                            <form class="d-flex justify-content-between" action="{{route('order.make_all_notifications_as_read')}}" method="POST" id="perform_order">--}}
                        <form class="d-flex justify-content-between" action="#" method="POST" id="perform_order">
                            @csrf
                            @method('POST')
                            <a type="button" class="btn btn-danger my-2" data-bs-dismiss="modal"> {{ translate_title('No')}}</a>
                            <button type="submit" class="btn btn-success my-2"> {{ translate_title('Yes')}} </a>
                        </form>
                    </div>
                </div>
            </div>

        </div><!-- /.modal-dialog -->
    </div>

    <!-- Topbar Start -->
    <div class="navbar-custom">
        <ul class="list-unstyled topnav-menu float-end mb-0">
            <li>
                <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#change_cashier"><h4>{{translate_title('Change cashier')}} <span class="mdi mdi-logout"></span></h4></a>
            </li>
            <li>
                <div>
                    <div class="align-items-center d-flex" id="lang-change">
                        <a class="buttonUzbDropDownHeader" type="button" id="dropdownMenuButton" role="button"
                           data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" href="javascript:void(0);">
                            @switch($locale)
                                @case('uz')
                                <img class="notifRegion2" id="selected_language"
                                     src="{{ asset('/images/language/region.png') }}" alt="region">
                                @break

                                @case('en')
                                <img class="notifRegion2" id="selected_language"
                                     src="{{ asset('/images/language/GB.png') }}" alt="region">
                                @break

                                @case('ru')
                                <img class="notifRegion2" id="selected_language"
                                     src="{{ asset('/images/language/RU.png') }}" alt="region">
                                @break
                            @endswitch
                            <h6 class="ms-1">{{strtoupper($locale)}}</h6>
                        </a>
                        <div id="language_flag" class="language_flag display-none"
                             aria-labelledby="dropdownMenuButton">
                            <div class="up-arrow"></div>
                            <div class="dropdownMenyApplyUzbFlag">
                                @foreach (\App\Models\Language::all() as $key => $language)
                                    <a href="javascript:void(0)" data-flag="{{ $language->code??'' }}"
                                       class="dropdown-item dropdown-item dropdownLanguageItem @if ($locale == $language->code??'') active @endif" >
                                        @switch($language->code)
                                            @case('uz')
                                            <img class="dropdownRegionBayroq me-2" id="lang_uz" src="{{asset('/images/language/region.png')}}" alt="region">
                                            {{ $language->name??'' }}
                                            @break

                                            @case('ru')
                                            <img class="dropdownRegionBayroq me-2" id="lang_ru"
                                                 src="{{ asset('/images/language/RU.png') }}" alt="region">
                                            {{ $language->name??'' }}
                                            @break

                                            @case('en')
                                            <img class="dropdownRegionBayroq me-2" id="lang_en"
                                                 src="{{ asset('/images/language/GB.png') }}" alt="region">
                                            {{ $language->name??'' }}
                                            @break
                                        @endswitch
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                    <i class="fe-settings noti-icon"></i>
                </a>
            </li>
        </ul>

        <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
            <li>
                <a class="text-decoration-none" href="{{route('cashier.index')}}"><h4>{{translate_title('Back')}} <span class="mdi mdi-arrow-left-bold"></span></h4></a>
            </li>
            <li>
                <h4>@yield('title')</h4>
            </li>
        </ul>
        <ul class="list-unstyled topnav-menu float-end mb-0">
            <li><h6>{{$user->name}} {{$user->surname}}</h6></li>
        </ul>
        <div class="clearfix"></div>

    </div>
    <!-- end Topbar -->
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <br>
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>

    </div> <!-- content -->
</div>

<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title">
            <a href="javascript:void(0);" class="right-bar-toggle float-end">
                <i class="mdi mdi-close"></i>
            </a>
            <h4 class="font-16 m-0 text-white">{{ translate_title('Theme Customizer')}}</h4>
        </div>
        <!-- Tab panes -->
        <div class="tab-content pt-0">

            <div class="tab-pane active" id="settings-tab" role="tabpanel">

                <div class="p-3">
                    <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">{{ translate_title('Color Scheme')}}</h6>
                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="layout-color" value="light"
                               id="light-mode-check" />
                        <label class="form-check-label" for="light-mode-check">{{ translate_title('Light Mode')}}</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="layout-color" value="dark"
                               id="dark-mode-check" checked/>
                        <label class="form-check-label" for="dark-mode-check">{{ translate_title('Dark Mode')}}</label>
                    </div>

                    <!-- Width -->
                    <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">{{ translate_title('Width')}}</h6>
                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="layout-size" value="fluid"
                               id="fluid" checked />
                        <label class="form-check-label" for="fluid-check">{{ translate_title('Fluid')}}</label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="layout-size" value="boxed"
                               id="boxed" />
                        <label class="form-check-label" for="boxed-check">{{ translate_title('Boxed')}}</label>
                    </div>

                    <!-- Menu positions -->
                    <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">{{ translate_title('Menus (Leftsidebar and Topbar) Positon')}}</h6>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftbar-position" value="fixed"
                               id="fixed-check" checked />
                        <label class="form-check-label" for="fixed-check">{{ translate_title('Fixed')}}</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftbar-position"
                               value="scrollable" id="scrollable-check" />
                        <label class="form-check-label" for="scrollable-check">{{ translate_title('Scrollable')}}</label>
                    </div>

                    <!-- Left Sidebar-->
                    <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">{{ translate_title('Left Sidebar Color')}}</h6>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftbar-color" value="light"
                               id="light" />
                        <label class="form-check-label" for="light-check">{{ translate_title('Light')}}</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftbar-color" value="dark"
                               id="dark" checked />
                        <label class="form-check-label" for="dark-check">{{ translate_title('Dark')}}</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftbar-color" value="brand"
                               id="brand" />
                        <label class="form-check-label" for="brand-check">{{ translate_title('Brand')}}</label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input" name="leftbar-color" value="gradient"
                               id="gradient" />
                        <label class="form-check-label" for="gradient-check">{{ translate_title('Gradient')}}</label>
                    </div>

                    <!-- size -->
                    <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">{{ translate_title('Left Sidebar Size')}}</h6>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftbar-size" value="default"
                               id="default-size-check" checked />
                        <label class="form-check-label" for="default-size-check">{{ translate_title('Default')}}</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftbar-size" value="condensed"
                               id="condensed-check" />
                        <label class="form-check-label" for="condensed-check">{{ translate_title('Condensed')}} <small>{{ translate_title('(Extra Small size)')}}</small></label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftbar-size" value="compact"
                               id="compact-check" />
                        <label class="form-check-label" for="compact-check">{{ translate_title('Compact')}} <small>{{ translate_title('(Small size)')}}</small></label>
                    </div>
                    <!-- Topbar -->
                    <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">{{ translate_title('Topbar')}}</h6>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="topbar-color" value="dark"
                               id="darktopbar-check" checked />
                        <label class="form-check-label" for="darktopbar-check">{{ translate_title('Dark')}}</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="topbar-color" value="light"
                               id="lighttopbar-check" />
                        <label class="form-check-label" for="lighttopbar-check">{{ translate_title('Light')}}</label>
                    </div>

                    <div class="d-grid mt-4">
                        <a class="btn btn-primary" id="resetBtn">{{ translate_title('Reset to Default')}}</a>
                        {{-- <a href="https://1.envato.market/admintoadmin" class="btn btn-danger mt-3" target="_blank"><i class="mdi mdi-basket me-1"></i> Purchase Now</a> --}}
                    </div>

                </div>

            </div>
        </div>

    </div> <!-- end slimscroll-menu-->
</div>

<!-- Full width modal content -->
<div id="payment_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content ps-4 pe-4">
            <div class="modal-header">
                <div class="row width_100_percent">
                    <div class="col-3">
                        <div class="text-center">
                            <strong class="me-auto">{{translate_title('Payment sum')}}</strong>
                        </div>
                        <div class="input-display_" id="payment_sum">0</div>
                    </div>
                    <div class="col-3">
                        <div class="text-center">
                            <strong class="me-auto">{{translate_title('Accepting sum')}}</strong>
                        </div>
                        <div class="input-display_" id="accepting_sum">0</div>
                    </div>
                    <div class="col-3">
                        <div class="text-center">
                            <strong class="me-auto">{{translate_title('Leaving sum')}}</strong>
                        </div>
                        <div class="input-display_" id="leaving_sum">0</div>
                    </div>
                    <div class="col-3">
                        <div class="text-center">
                            <strong class="me-auto">{{translate_title('Change sum')}}</strong>
                        </div>
                        <div class="input-display_" id="change_sum">0</div>
                    </div>
                </div>
                <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-header d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary waves-effect active" onclick="setCash(this)">{{translate_title('Наличные')}}</button>
                <button type="button" class="btn btn-outline-secondary waves-effect" onclick="setCard(this)">{{translate_title('Безналичные')}}</button>
                <button type="button" class="btn btn-outline-secondary waves-effect" onclick="setMixed(this)">{{translate_title('Смешанные')}}</button>
            </div>
            <div class="modal-body d-flex justify-content-between" id="calculators">
                <div class="mt-2 cash_calculator" id="cashCalculator">
                    <h4>{{translate_title('Ввод сумма наличие')}}</h4>
                    <!-- Sonni ko'rsatish joyi -->
                    <div class="row">
                        <div class="col-12">
                            <div id="display" class="input-display">0</div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <!-- Raqamlar tugmalari -->
                        <div class="row mb-2">
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumber(1)">1</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumber(2)">2</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumber(3)">3</a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="row mb-2">
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumber(4)">4</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumber(5)">5</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumber(6)">6</a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="row mb-2">
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumber(7)">7</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumber(8)">8</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumber(9)">9</a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="row mb-2">
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumber(0)">0</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="clearDisplay()">Clear</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="backspace()">
                                    <span class="mdi mdi-backspace"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 cash_calculator d-none" id="cardCalculator">
                    <h4>{{translate_title('Ввод сумма безналичие')}}</h4>
                    <!-- Sonni ko'rsatish joyi -->
                    <div class="row">
                        <div class="col-12">
                            <div id="display_card" class="input-display">0</div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <!-- Raqamlar tugmalari -->
                        <div class="row mb-2">
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumberCard(1)">1</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumberCard(2)">2</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumberCard(3)">3</a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="row mb-2">
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumberCard(4)">4</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumberCard(5)">5</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumberCard(6)">6</a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="row mb-2">
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumberCard(7)">7</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumberCard(8)">8</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumberCard(9)">9</a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="row mb-2">
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="appendNumberCard(0)">0</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="clearDisplayCard()">Clear</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number" onclick="backspaceCard()">
                                    <span class="mdi mdi-backspace"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body d-flex justify-content-center d-none" id="cardContent">
                <input class="input-display" type="text" id="card_payment_" readonly>
            </div>
            <div class="modal-footer">
                <a class="btn modal_close height_50" data-bs-dismiss="modal">{{translate_title('Close')}}</a>
                <a class="btn modal_confirm height_50">{{translate_title('Payment')}}</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="delete_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled">
            <div class="modal-body">
                <div class="text-center">
                    <img src="{{asset('img/delete_icon.png')}}" alt="" height="100px">
                    <h4 class="mt-2 delete_text_content">{{ translate_title('Вы уверены, что хотите удалить это?')}}</h4>
                    <form action="" method="POST" id="delete_form">
                        @csrf
                        @method('DELETE')
                        <div class="d-flex justify-content-between width_100_percent">
                            <a type="button" class="btn delete_modal_close my-2" data-bs-dismiss="modal"> {{ translate_title('No')}}</a>
                            <button type="submit" class="btn delete_modal_confirm my-2"> {{ translate_title('Yes')}} </a>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="images-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog d-flex align-items-center">
        <div class="modal-content" style="background-color: transparent">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner" id="image_content_">

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="logout-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <i class="dripicons-warning h1 text-warning"></i>
                    <h4 class="mt-2">{{translate_title('Logout')}}</h4>
                    <p class="mt-3">{{translate_title('Confirm to logout')}}</p>
                    <div class="d-flex justify-content-around">
                        <a type="button" class="btn btn-danger my-2" data-bs-dismiss="modal">{{translate_title('No')}}</a>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            @method("POST")
                            <button type="submit" class="btn btn-warning my-2" data-bs-dismiss="modal">
                                {{translate_title('Yes')}}
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="change_cashier"
     aria-labelledby="staticBackdropLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h4>{{translate_title('Do you want to change cashier')}}</h4>
            </div>
            <form class="modal-body card-body" action="{{route('changeCashier')}}" method="POST">
                @csrf
                @method('POST')
                <div class="form-floating mb-3">
                    <select class="form-select" name="cashier_id" id="floatingSelect" aria-label="Floating label select example">
                        @foreach($cashiers as $cashier)
                            <option value="{{$cashier['id']}}">{{$cashier['name']}}{{$cashier['surname']}}</option>
                        @endforeach
                    </select>
                    <label for="floatingSelect">{{translate_title('Select a cashier')}}</label>
                </div>
                <input type="hidden" id="cashier_password" name="password">
                <div class="mt-2">
                    <h4>{{translate_title('Parol kiritish')}}</h4>

                    <!-- Sonni ko'rsatish joyi -->
                    <div class="row">
                        <div class="col-12">
                            <div id="display_password" class="input-display_password">0</div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <!-- Raqamlar tugmalari -->
                        <div class="row mb-2">
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number-password" onclick="appendPassword(1)">1</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number-password" onclick="appendPassword(2)">2</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number-password" onclick="appendPassword(3)">3</a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="row mb-2">
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number-password" onclick="appendPassword(4)">4</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number-password" onclick="appendPassword(5)">5</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number-password" onclick="appendPassword(6)">6</a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="row mb-2">
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number-password" onclick="appendPassword(7)">7</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number-password" onclick="appendPassword(8)">8</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number-password" onclick="appendPassword(9)">9</a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="row mb-2">
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number-password" onclick="appendPassword(0)">0</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number-password" onclick="clearDisplayPassword()">Clear</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-dark btn-number-password" onclick="backspacePassword()">
                                    <span class="mdi mdi-backspace"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between width_100_percent mt-4">
                    <a class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close')}}</a>
                    <button type="submit" class="btn modal_confirm">{{translate_title('Confirm')}}</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="rightbar-overlay"></div>
</body>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script src="{{asset('js/pusher_commands.js')}}"></script>
<script>
    // JavaScript

    // Display element
    let display = document.getElementById('display');
    let display_card = document.getElementById('display_card');
    let display_password = document.getElementById('display_password');
    let cashier_password = document.getElementById('cashier_password')
    let entered_sum = '0'
    let cash_sum = 0
    let card_sum = 0

    let getTotalSum = 0
    let payment_sum = document.getElementById('payment_sum')
    let accepting_sum = document.getElementById('accepting_sum')
    let leaving_sum = document.getElementById('leaving_sum')
    let change_sum = document.getElementById('change_sum')

    let calculators = document.getElementById('calculators')
    let cashCalculator = document.getElementById('cashCalculator')
    let cardCalculator = document.getElementById('cardCalculator')
    let cardContent = document.getElementById('cardContent')
    let card_payment_ = document.getElementById('card_payment_')

    function format_entered_sum(numbers){
        if(parseInt(numbers)>0){
            return parseInt(numbers).toLocaleString()
        }else{
            return 0
        }
    }

    // Function to append numbers to the display
    function appendNumber(number) {
        if (display.innerText == '0') {
            entered_sum = parseInt(number)
            cash_sum = entered_sum
            display.innerText = String(entered_sum); // Agar dastlabki raqam 0 bo'lsa, uni o'zgartiramiz
            accepting_sum.innerText = String(entered_sum)
            leaving_sum.innerText = format_entered_sum(parseInt(getTotalSum) - parseInt(entered_sum))
            change_sum.innerText = format_entered_sum(parseInt(entered_sum) - parseInt(getTotalSum))
        } else {
            entered_sum = String(entered_sum) + number
            cash_sum = parseInt(entered_sum)
            display.innerText = format_entered_sum(entered_sum); // Aks holda, raqamni qo'shamiz
            accepting_sum.innerText = format_entered_sum(entered_sum); // Aks holda, raqamni qo'shamiz
            leaving_sum.innerText = format_entered_sum(parseInt(getTotalSum) - parseInt(entered_sum))
            change_sum.innerText = format_entered_sum(parseInt(entered_sum) - parseInt(getTotalSum))
        }
    }

    // Function to append numbers to the display
    function appendNumberCard(number) {
        if (display_card.innerText == '0') {
            entered_sum = parseInt(number)
            card_sum = entered_sum
            display_card.innerText = String(entered_sum); // Agar dastlabki raqam 0 bo'lsa, uni o'zgartiramiz
            accepting_sum.innerText = String(entered_sum)
            leaving_sum.innerText = format_entered_sum(parseInt(getTotalSum) - parseInt(entered_sum))
            change_sum.innerText = format_entered_sum(parseInt(entered_sum) - parseInt(getTotalSum))
        } else {
            entered_sum = String(entered_sum) + number
            card_sum = parseInt(entered_sum)
            display_card.innerText = format_entered_sum(entered_sum); // Aks holda, raqamni qo'shamiz
            accepting_sum.innerText = format_entered_sum(entered_sum); // Aks holda, raqamni qo'shamiz
            leaving_sum.innerText = format_entered_sum(parseInt(getTotalSum) - parseInt(entered_sum))
            change_sum.innerText = format_entered_sum(parseInt(entered_sum) - parseInt(getTotalSum))
        }
    }

    // Function to clear the display
    function clearDisplay() {
        if(card_sum != 0){
            entered_sum = card_sum
        }else{
            entered_sum = '0'
        }
        display.innerText = '0'; // Ekrandagi raqamni tozalash
        accepting_sum.innerText = '0'; // Ekrandagi raqamni tozalash
        leaving_sum.innerText = format_entered_sum(getTotalSum)
        change_sum.innerText = '0'
    }

    // Function to clear the display
    function clearDisplayCard() {
        if(display.innerText != '0'){
            entered_sum = '0'
        }else{
            entered_sum = display.innerText
        }
        display_card.innerText = '0'; // Ekrandagi raqamni tozalash
        accepting_sum.innerText = '0'; // Ekrandagi raqamni tozalash
        leaving_sum.innerText = format_entered_sum(getTotalSum)
        change_sum.innerText = '0'
    }
    // Function to remove the last digit (Backspace)
    function backspace() {
        if (display.innerText.length > 1) {
            entered_sum = String(entered_sum).slice(0, -1)
            display.innerText = format_entered_sum(entered_sum); // Oxirgi belgini o'chirish
            accepting_sum.innerText = format_entered_sum(entered_sum); // Oxirgi belgini o'chirish
            leaving_sum.innerText = format_entered_sum(parseInt(getTotalSum) - parseInt(entered_sum))
            change_sum.innerText = format_entered_sum(parseInt(entered_sum) - parseInt(getTotalSum))
        } else {
            display.innerText = '0'; // Agar faqat bir raqam qolgan bo'lsa, uni 0 ga o'zgartiramiz
            entered_sum = '0'
            accepting_sum.innerText = '0'
            leaving_sum.innerText = format_entered_sum(getTotalSum)
            change_sum.innerText = '0'
        }
    }

    // Function to remove the last digit (Backspace)
    function backspaceCard() {
        if (display_card.innerText.length > 1) {
            entered_sum = String(entered_sum).slice(0, -1)
            display_card.innerText = format_entered_sum(entered_sum); // Oxirgi belgini o'chirish
            accepting_sum.innerText = format_entered_sum(entered_sum); // Oxirgi belgini o'chirish
            leaving_sum.innerText = format_entered_sum(parseInt(getTotalSum) - parseInt(entered_sum))
            change_sum.innerText = format_entered_sum(parseInt(entered_sum) - parseInt(getTotalSum))
        } else {
            display_card.innerText = '0'; // Agar faqat bir raqam qolgan bo'lsa, uni 0 ga o'zgartiramiz
            entered_sum = '0'
            accepting_sum.innerText = '0'
            leaving_sum.innerText = format_entered_sum(getTotalSum)
            change_sum.innerText = '0'
        }
    }

    // Function to append numbers to the display
    function appendPassword(number) {
        if (display_password.innerText == '0') {
            cashier_password.value = String(number)
            display_password.innerText = String(number); // Agar dastlabki raqam 0 bo'lsa, uni o'zgartiramiz
        } else {
            cashier_password.value = String(cashier_password.value) + String(number)
            display_password.innerText = cashier_password.value; // Aks holda, raqamni qo'shamiz
        }
    }

    // Function to clear the display
    function clearDisplayPassword() {
        cashier_password.value = '0'
        display_password.innerText = '0'; // Ekrandagi raqamni tozalash
    }
    // Function to remove the last digit (Backspace)
    function backspacePassword() {
        if (display_password.innerText.length > 1) {
            cashier_password.value = String(cashier_password.value).slice(0, -1)
            display_password.innerText = String(cashier_password.value); // Oxirgi belgini o'chirish
        } else {
            display_password.innerText = '0'; // Agar faqat bir raqam qolgan bo'lsa, uni 0 ga o'zgartiramiz
            cashier_password.value = '0'
        }
    }

    function paymentFunc() {
        getTotalSum = total_sum.innerText
        payment_sum.innerText = format_entered_sum(getTotalSum)
        change_sum.innerText = '0'
    }

    let payment_types = document.querySelectorAll('#payment_modal .btn-outline-secondary')

    function setPaymentTypes(button_){
        for(let ij = 0;ij<payment_types.length; ij++){
            if(payment_types[ij].classList.contains('active')){
                payment_types[ij].classList.remove('active')
            }
        }
        if(!button_.classList.contains('active')){
            button_.classList.add('active')
        }
    }
    function setCash(button__) {
        // calculators
        // cashCalculator
        // cardCalculator
        if(!cardContent.classList.contains('d-none')){
            cardContent.classList.add('d-none')
        }
        if(!cardCalculator.classList.contains('d-none')){
            cardCalculator.classList.add('d-none')
        }
        if(cashCalculator.classList.contains('d-none')){
            cashCalculator.classList.remove('d-none')
        }
        if(calculators.classList.contains('d-none')){
            calculators.classList.remove('d-none')
        }
        setPaymentTypes(button__)
    }
    function setCard(button__) {
        if(cardContent.classList.contains('d-none')){
            cardContent.classList.remove('d-none')
        }
        if(!cashCalculator.classList.contains('d-none')){
            cashCalculator.classList.add('d-none')
        }
        if(!cardCalculator.classList.contains('d-none')){
            cardCalculator.classList.add('d-none')
        }
        if(!calculators.classList.contains('d-none')){
            calculators.classList.add('d-none')
        }
        card_payment_.value = format_entered_sum(getTotalSum)
        setPaymentTypes(button__)
    }
    function setMixed(button__) {
        if(!cardContent.classList.contains('d-none')){
            cardContent.classList.add('d-none')
        }
        if(cashCalculator.classList.contains('d-none')){
            cashCalculator.classList.remove('d-none')
        }
        if(cardCalculator.classList.contains('d-none')){
            cardCalculator.classList.remove('d-none')
        }
        if(calculators.classList.contains('d-none')){
            calculators.classList.remove('d-none')
        }
        setPaymentTypes(button__)
    }
</script>
<script>
    let items_selected_text = "{{translate_title('items selected')}}"
    let search_client_text = "{{translate_title('Поиск')}}"

    // $(document).ready(function() {
    //     $('.basic-datepicker').flatpickr();
    // })

    $(document).ready(function() {
        let sessionSuccess ="{{session('status')}}";
        if(sessionSuccess){
            toastr.success(sessionSuccess)
        }
        let sessionError ="{{session('error')}}";
        if(sessionError){
            toastr.warning(sessionError)
        }
        let uz = `{{ asset('/assets/images/language/region.png') }}`
        let ru = `{{ asset('/assets/images/language/RU.png') }}`
        let en = `{{ asset('/assets/images/language/GB.png') }}`

        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdownMenyApplyUzbFlag a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    switch (locale) {
                        case 'uz':
                            $('#selected_language').attr('src', uz)
                            break;
                        case 'en':
                            $('#selected_language').attr('src', en)
                            break;
                        case 'ru':
                            $('#selected_language').attr('src', ru)
                            break;
                    }
                    $.post('{{ route('language.change') }}', {
                        _token: '{{ csrf_token() }}',
                        locale: locale
                    }, function(data) {
                        location.reload();
                    });

                });
            });
        }
    })
</script>
<script>

    //light mode or dark mode
    let light_mode = document.getElementById('light-mode-check')
    let dark_mode = document.getElementById('dark-mode-check')
    let body_layout = document.getElementById('body_layout')
    let wrapper = document.getElementById('wrapper')
    let content_page = document.querySelector('.content-page')
    let modal_content = document.querySelector('.modal-content')
    let layout_local = localStorage.getItem('layout_local')
    light_mode.addEventListener('click', function (){
        localStorage.setItem('layout_local', 'light')
        removeDarkContainer(content_page)
        removeDarkContainer(modal_content)
    })
    dark_mode.addEventListener('click', function (){
        localStorage.setItem('layout_local', 'dark')
        setDarkContainer(content_page)
        setDarkContainer(modal_content)
    })
    if(layout_local == undefined || layout_local == null){
        body_layout.setAttribute('data-layout-color', 'default')
    }else{
        body_layout.setAttribute('data-layout-color', layout_local)
        if(layout_local == 'light'){
            removeDarkContainer(content_page)
            removeDarkContainer(modal_content)
        }else if(layout_local == 'dark'){
            setDarkContainer(content_page)
            setDarkContainer(modal_content)
        }
    }

    function removeDarkContainer(modal_container){
        if(modal_container != undefined && modal_container != null){
            if(modal_container.classList.contains('back_dark')){
                modal_container.classList.remove('back_dark')
            }
        }
        if(wrapper != undefined && wrapper != null){
            if(wrapper.classList.contains('back_dark')){
                wrapper.classList.remove('back_dark')
            }
        }
    }
    function setDarkContainer(modal_container){
        if(modal_container != undefined && modal_container != null){
            if(!modal_container.classList.contains('back_dark')){
                modal_container.classList.add('back_dark')
            }
        }
        if(wrapper != undefined && wrapper != null){
            if(!wrapper.classList.contains('back_dark')){
                wrapper.classList.add('back_dark')
            }
        }
    }


    //fluid or boxed
    let fluid = document.getElementById('fluid')
    let boxed = document.getElementById('boxed')
    fluid.addEventListener('click', function (){
        localStorage.setItem('fluid_or_boxed', 'fluid')
    })
    boxed.addEventListener('click', function (){
        localStorage.setItem('fluid_or_boxed', 'boxed')
    })
    if(localStorage.getItem('fluid_or_boxed') == undefined || localStorage.getItem('fluid_or_boxed') == null){
        body_layout.setAttribute('data-layout-size', 'fluid')
    }else{
        body_layout.setAttribute('data-layout-size', localStorage.getItem('fluid_or_boxed'))
    }

    //fixed or scrollable
    let fixed_check = document.getElementById('fixed-check')
    let scrollable_check = document.getElementById('scrollable-check')
    fixed_check.addEventListener('click', function (){
        localStorage.setItem('fixed_or_scrollable', 'fixed')
    })
    scrollable_check.addEventListener('click', function (){
        localStorage.setItem('fixed_or_scrollable', 'scrollable')
    })
    if(localStorage.getItem('fixed_or_scrollable') == undefined || localStorage.getItem('fixed_or_scrollable') == null){
        body_layout.setAttribute('data-leftbar-positione', 'fixed')
    }else{
        body_layout.setAttribute('data-leftbar-position', localStorage.getItem('fixed_or_scrollable'))
    }

    //fixed or scrollable
    let light = document.getElementById('light')
    let dark = document.getElementById('dark')
    let brand = document.getElementById('brand')
    let gradient = document.getElementById('gradient')
    light.addEventListener('click', function (){
        localStorage.setItem('leftbar_color', 'light')
    })
    dark.addEventListener('click', function (){
        localStorage.setItem('leftbar_color', 'dark')
    })
    brand.addEventListener('click', function (){
        localStorage.setItem('leftbar_color', 'brand')
    })
    gradient.addEventListener('click', function (){
        localStorage.setItem('leftbar_color', 'gradient')
    })
    if(localStorage.getItem('leftbar_color') == undefined || localStorage.getItem('leftbar_color') == null){
        body_layout.setAttribute('data-leftbar-color', 'light')
    }else{
        body_layout.setAttribute('data-leftbar-color', localStorage.getItem('leftbar_color'))
    }

    //fixed or scrollable
    let default_size_check = document.getElementById('default-size-check')
    let condensed_check = document.getElementById('condensed-check')
    let compact_check = document.getElementById('compact-check')
    default_size_check.addEventListener('click', function (){
        localStorage.setItem('leftbar_size', 'default')
    })
    condensed_check.addEventListener('click', function (){
        localStorage.setItem('leftbar_size', 'condensed')
    })
    compact_check.addEventListener('click', function (){
        localStorage.setItem('leftbar_size', 'compact')
    })
    if(localStorage.getItem('leftbar_size') == undefined || localStorage.getItem('leftbar_size') == null){
        body_layout.setAttribute('data-leftbar-size', 'default')
    }else{
        body_layout.setAttribute('data-leftbar-size', localStorage.getItem('leftbar_size'))
    }

    //Topbar color
    let darktopbar_check = document.getElementById('darktopbar-check')
    let lighttopbar_check = document.getElementById('lighttopbar-check')
    darktopbar_check.addEventListener('click', function (){
        localStorage.setItem('topbar_color', 'dark')
    })
    lighttopbar_check.addEventListener('click', function (){
        localStorage.setItem('topbar_color', 'light')
    })
    if(localStorage.getItem('topbar_color') == undefined || localStorage.getItem('topbar_color') == null){
        body_layout.setAttribute('data-topbar-color', 'light')
    }else{
        body_layout.setAttribute('data-topbar-color', localStorage.getItem('topbar_color'))
    }

    // Reset to default
    let resetBtn = document.getElementById('resetBtn')
    resetBtn.addEventListener('click', function (){
        if(localStorage.getItem('topbar_color') != undefined || localStorage.getItem('topbar_color') != null){
            localStorage.removeItem('topbar_color')
        }
        if(localStorage.getItem('leftbar_size') != undefined || localStorage.getItem('leftbar_size') != null){
            localStorage.removeItem('leftbar_size')
        }
        if(localStorage.getItem('leftbar_color') != undefined || localStorage.getItem('leftbar_color') != null){
            localStorage.removeItem('leftbar_color')
        }
        if(localStorage.getItem('fixed_or_scrollable') != undefined || localStorage.getItem('fixed_or_scrollable') != null){
            localStorage.removeItem('fixed_or_scrollable')
        }
        if(localStorage.getItem('fluid_or_boxed') != undefined || localStorage.getItem('fluid_or_boxed') != null){
            localStorage.removeItem('fluid_or_boxed')
        }
        if(localStorage.getItem('layout_local') != undefined || localStorage.getItem('layout_local') != null){
            localStorage.removeItem('layout_local')
        }
        location.reload();
    })

</script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/datatables_style.js') }}"></script>
<!-- Vendor -->

<script src="{{ asset('libs/jstree/jstree.min.js') }}"></script>
<script src="{{ asset('js/pages/treeview.init.js') }}"></script>

<script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('libs/parsleyjs/parsley.min.js') }}"></script>

<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('libs/x-editable/bootstrap-editable/js/bootstrap-editable.min.js') }}"></script>

<!-- Init js-->
<script src="{{ asset('js/pages/form-xeditable.init.js') }}"></script>

<script src="{{ asset('js/pages/form-validation.init.js') }}"></script>

<script src="{{ asset('libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('libs/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('libs/pdfmake/build/vfs_fonts.js') }}"></script>

<script src="{{asset('libs/dropzone/min/dropzone.min.js')}}"></script>
<script src="{{asset('libs/dropify/js/dropify.min.js')}}"></script>
<!-- Init js-->
<script src="{{asset('js/pages/form-fileuploads.init.js')}}"></script>
<!-- knob plugin -->
<script src="{{ asset('libs/jquery-knob/jquery.knob.min.js') }}"></script>

<script src="{{asset('libs/selectize/js/standalone/selectize.min.js')}}"></script>
<script src="{{asset('libs/mohithg-switchery/switchery.min.js')}}"></script>
<script src="{{asset('libs/multiselect/js/jquery.multi-select.js')}}"></script>
<script src="{{asset('libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('libs/devbridge-autocomplete/jquery.autocomplete.min.js')}}"></script>
<script src="{{asset('libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

<script src="{{ asset('js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>

<!--Morris Chart-->
<script src="{{ asset('libs/morris.js06/morris.min.js') }}"></script>
<script src="{{ asset('libs/raphael/raphael.min.js') }}"></script>

<script src="{{ asset('js/pages/form-pickers.init.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>

<script>
    "use strict";
    let orders_ordered = {name:"{{translate_title('Orders active')}}", count:"1"}
    let orders_performed = {name:"{{translate_title('Orders performed')}}", count:"2"}
    let order_cancelled = {name:"{{translate_title('Cancelled orders')}}", count:"5"}
    let orders_accepted = {name:"{{translate_title('Completed orders')}}", count:"4"}
    {{--let monthly_orders_count = {!! 74??0 !!}--}}
    {{--let monthly_offers_count = {!! 12??0 !!}--}}
    {{--let order_created = "{{translate_title('Order created')}}"--}}
    {{--let offer_created = "{{translate_title('Offer created')}}"--}}
    const month_names = ["","January","February","March","April","May","June","July",
        "August","September","October","November","December"];
    !function(e){
        function a(){
            this.$realData=[]
        }
        a.prototype.createBarChart=function(e,a,r,t,o,i){
            Morris.Bar({
                element:e,data:a,xkey:r,ykeys:t,labels:o,hideHover:"auto",resize:!0,gridLineColor:"rgba(173, 181, 189, 0.1)",barSizeRatio:.2,dataLabels:!1,barColors:i
            })
        },
            a.prototype.createDonutChart=function(e,a,r)
            {
                Morris.Donut({element:e,data:a,resize:!0,colors:r,backgroundColor:"transparent"})
            },
            a.prototype.init=function(){
                e("#morris-bar-example").empty(),
                    e("#morris-line-example").empty(),
                    e("#morris-donut-example").empty();
                this.createDonutChart(
                    "morris-donut-example",
                    [
                        {label: orders_ordered.name, value: orders_ordered.count},
                        {label: orders_performed.name, value: orders_performed.count},
                    ],
                    ["#FF6C37", "#10C469"]
                )
                this.createDonutChart(
                    "morris-donut-example-1",
                    [
                        {label: orders_ordered.name, value: orders_ordered.count},
                        {label: orders_performed.name, value: orders_performed.count},
                        {label: order_cancelled.name, value: order_cancelled.count},
                        {label: orders_accepted.name, value: orders_accepted.count}
                    ],
                    ["#FF6C37", "#10C469", "#FF0000", "#00ADD7"]
                )
                this.createDonutChart(
                    "morris-donut-example-2",
                    [
                        {label: order_cancelled.name, value: order_cancelled.count},
                        {label: orders_accepted.name, value: orders_accepted.count}
                    ],
                    ["#FF0000", "#00ADD7"]
                )
            },
            e.Dashboard1=new a,
            e.Dashboard1.Constructor=a
    }(window.jQuery),function(a){a.Dashboard1.init(),window.addEventListener("adminto.setBoxed",function(e){a.Dashboard1.init()}),window.addEventListener("adminto.setFluid",function(e){a.Dashboard1.init()})}(window.jQuery);

</script>
</body>

</html>
