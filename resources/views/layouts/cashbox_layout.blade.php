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
    </style>
    <link rel="stylesheet" href="{{asset('css/cashbox.css')}}">
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
                            <h4 class="mt-2">{{ translate_title('Are you sure you want to make all notifications as read', $lang)}}</h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{--                            <form class="d-flex justify-content-between" action="{{route('order.make_all_notifications_as_read')}}" method="POST" id="perform_order">--}}
                        <form class="d-flex justify-content-between" action="#" method="POST" id="perform_order">
                            @csrf
                            @method('POST')
                            <a type="button" class="btn btn-danger my-2" data-bs-dismiss="modal"> {{ translate_title('No', $lang)}}</a>
                            <button type="submit" class="btn btn-success my-2"> {{ translate_title('Yes', $lang)}} </button>
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
                <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#change_cashier"><h4>{{translate_title('Change cashier', $lang)}} <span class="mdi mdi-logout"></span></h4></a>
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

        <ul class="list-unstyled topnav-menu topnav-menu-left">
            <li>
                <a class="text-decoration-none" href="{{route('cashier.index')}}"><h4>{{translate_title('Back', $lang)}} <span class="mdi mdi-arrow-left-bold"></span></h4></a>
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
            <h4 class="font-16 m-0 text-white">{{ translate_title('Theme Customizer', $lang)}}</h4>
        </div>
        <!-- Tab panes -->
        <div class="tab-content pt-0">

            <div class="tab-pane active" id="settings-tab" role="tabpanel">

                <div class="p-3">
                    <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">{{ translate_title('Color Scheme', $lang)}}</h6>
                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="layout-color" value="light"
                               id="light-mode-check" />
                        <label class="form-check-label" for="light-mode-check">{{ translate_title('Light Mode', $lang)}}</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="layout-color" value="dark"
                               id="dark-mode-check" checked/>
                        <label class="form-check-label" for="dark-mode-check">{{ translate_title('Dark Mode', $lang)}}</label>
                    </div>

                    <!-- Menu positions -->
                    <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">{{ translate_title('Menus (Leftsidebar and Topbar) Positon', $lang)}}</h6>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftbar-position" value="fixed"
                               id="fixed-check" checked />
                        <label class="form-check-label" for="fixed-check">{{ translate_title('Fixed', $lang)}}</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftbar-position"
                               value="scrollable" id="scrollable-check" />
                        <label class="form-check-label" for="scrollable-check">{{ translate_title('Scrollable', $lang)}}</label>
                    </div>

                    <!-- Left Sidebar-->
                    <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">{{ translate_title('Left Sidebar Color', $lang)}}</h6>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftbar-color" value="light"
                               id="light" />
                        <label class="form-check-label" for="light-check">{{ translate_title('Light', $lang)}}</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftbar-color" value="dark"
                               id="dark" checked />
                        <label class="form-check-label" for="dark-check">{{ translate_title('Dark', $lang)}}</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftbar-color" value="brand"
                               id="brand" />
                        <label class="form-check-label" for="brand-check">{{ translate_title('Brand', $lang)}}</label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input" name="leftbar-color" value="gradient"
                               id="gradient" />
                        <label class="form-check-label" for="gradient-check">{{ translate_title('Gradient', $lang)}}</label>
                    </div>

                    <!-- size -->
                    <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">{{ translate_title('Left Sidebar Size', $lang)}}</h6>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftbar-size" value="default"
                               id="default-size-check" checked />
                        <label class="form-check-label" for="default-size-check">{{ translate_title('Default', $lang)}}</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftbar-size" value="condensed"
                               id="condensed-check" />
                        <label class="form-check-label" for="condensed-check">{{ translate_title('Condensed', $lang)}} <small>{{ translate_title('(Extra Small size)', $lang)}}</small></label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftbar-size" value="compact"
                               id="compact-check" />
                        <label class="form-check-label" for="compact-check">{{ translate_title('Compact', $lang)}} <small>{{ translate_title('(Small size)', $lang)}}</small></label>
                    </div>
                    <div class="d-grid mt-4">
                        <a class="btn btn-primary" id="resetBtn">{{ translate_title('Reset to Default', $lang)}}</a>
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
                            <strong class="me-auto">{{translate_title('Payment sum', $lang)}}</strong>
                        </div>
                        <div class="input-display_" id="payment_sum">0</div>
                    </div>
                    <div class="col-3">
                        <div class="text-center">
                            <strong class="me-auto">{{translate_title('Accepting sum', $lang)}}</strong>
                        </div>
                        <div class="input-display_" id="accepting_sum">0</div>
                    </div>
                    <div class="col-3">
                        <div class="text-center">
                            <strong class="me-auto">{{translate_title('Leaving sum', $lang)}}</strong>
                        </div>
                        <div class="input-display_" id="leaving_sum">0</div>
                    </div>
                    <div class="col-3">
                        <div class="text-center">
                            <strong class="me-auto">{{translate_title('Change sum', $lang)}}</strong>
                        </div>
                        <div class="input-display_" id="change_sum">0</div>
                    </div>
                </div>
                <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-header d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary waves-effect active" onclick="setCash(this)"><h6>{{translate_title('Наличные', $lang)}}</h6></button>
                <button type="button" class="btn btn-outline-secondary waves-effect" onclick="setCard(this)"><h6>{{translate_title('Безналичные', $lang)}}</h6></button>
                <button type="button" class="btn btn-outline-secondary waves-effect" onclick="setMixed(this)"><h6>{{translate_title('Смешанные', $lang)}}</h6></button>
            </div>
            <div class="modal-body d-flex justify-content-between" id="calculators">
                <div class="mt-2 cash_calculator" id="cashCalculator">
                    <h4>{{translate_title('Ввод сумма наличие', $lang)}}</h4>
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
                    <h4>{{translate_title('Ввод сумма безналичие', $lang)}}</h4>
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
                <a class="btn modal_close height_50 me-4" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</a>
                <a class="btn modal_confirm height_50" onclick="paymentPayFunc()">{{translate_title('Payment', $lang)}}</a>
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
                    <h4 class="mt-2 delete_text_content">{{ translate_title('Вы уверены, что хотите удалить это?', $lang)}}</h4>
                    <form action="" method="POST" id="delete_form">
                        @csrf
                        @method('DELETE')
                        <div class="d-flex justify-content-between width_100_percent">
                            <a type="button" class="btn delete_modal_close my-2" data-bs-dismiss="modal"> {{ translate_title('No', $lang)}}</a>
                            <button type="submit" class="btn delete_modal_confirm my-2"> {{ translate_title('Yes', $lang)}} </button>
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
                    <h4 class="mt-2">{{translate_title('Logout', $lang)}}</h4>
                    <p class="mt-3">{{translate_title('Confirm to logout', $lang)}}</p>
                    <div class="d-flex justify-content-around">
                        <a type="button" class="btn btn-danger my-2" data-bs-dismiss="modal">{{translate_title('No', $lang)}}</a>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            @method("POST")
                            <button type="submit" class="btn btn-warning my-2" data-bs-dismiss="modal">
                                {{translate_title('Yes', $lang)}}
                            </button>
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
                <h4>{{translate_title('Do you want to change cashier', $lang)}}</h4>
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
                    <label for="floatingSelect">{{translate_title('Select a cashier', $lang)}}</label>
                </div>
                <input type="hidden" id="cashier_password" name="password">
                <div class="mt-2">
                    <h4>{{translate_title('Parol kiritish', $lang)}}</h4>

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
                    <a class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</a>
                    <button type="submit" class="btn modal_confirm">{{translate_title('Confirm', $lang)}}</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="rightbar-overlay"></div>
</body>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script src="{{asset('js/pusher_commands.js')}}"></script>
<script src="{{asset('js/cashbox.js')}}"></script>
<script>
    let items_selected_text = "{{translate_title('items selected', $lang)}}"
    let search_client_text = "{{translate_title('Поиск', $lang)}}"

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
<script src="{{ asset('js/dark-light.js') }}"></script>
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
    let orders_ordered = {name:"{{translate_title('Orders active', $lang)}}", count:"1"}
    let orders_performed = {name:"{{translate_title('Orders performed', $lang)}}", count:"2"}
    let order_cancelled = {name:"{{translate_title('Cancelled orders', $lang)}}", count:"5"}
    let orders_accepted = {name:"{{translate_title('Completed orders', $lang)}}", count:"4"}

    {{--let monthly_orders_count = {!! 74??0 !!}--}}
    {{--let monthly_offers_count = {!! 12??0 !!}--}}
    {{--let order_created = "{{translate_title('Order created', $lang)}}"--}}
    {{--let offer_created = "{{translate_title('Offer created', $lang)}}"--}}

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
