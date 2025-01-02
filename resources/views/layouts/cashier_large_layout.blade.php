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

    <link href="{{ asset('css/input-switch.css') }}" rel="stylesheet" type="text/css" />

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
        .col-7, .order-section{
            padding: 0px !important;
        }
        .dataTables_wrapper{
            width: 100%;
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
            <li class="ms-4"><h6 class="mt_10">{{$user->name}} {{$user->surname}}</h6></li>
            <li>
                <a class="text-decoration-none ms-4" data-bs-toggle="modal" data-bs-target="#change_cashier"><h5 class="m-0"><span class="mdi mdi-logout me-2"></span></h5></a>
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
                            <span><h6>{{strtoupper($locale)}}</h6></span>
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
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown"
                   href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fe-bell noti-icon"></i>
                    @if(count($current_user->unreadnotifications)>0)
                        <span class="badge bg-danger rounded-circle noti-icon-badge">{{count($current_user->unreadnotifications)}}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                            <span class="float-end">
                                <a class="text-dark" data-bs-toggle="modal" data-bs-target="#clear_all_notifications">
                                    <small>{{translate_title('Clear All', $lang)}}</small>
                                </a>
                            </span>{{translate_title('Notification', $lang)}}
                        </h5>
                    </div>

                    <div class="noti-scroll" data-simplebar>
                        @forelse($current_user->unreadnotifications as $notification)
                            @if($notification->type == "App\Notifications\OrderNotification")
                                @if(!empty($notification->data))
                                    <a href="#" class="dropdown-item notify-item">
                                        <div class="notify-icon" style="background-image: url({{isset($notification->data['product_images'])?$notification->data['product_images']:''}})"></div>
                                        <p class="notify-details">
                                            @if(isset($notification->data['product_name']))
                                                {{strlen($notification->data['product_name'])>24?substr($notification->data['product_name'], 0, 24):$notification->data['product_name']}}...  <b>{{$notification->data['order_all_price']}}</b>
                                            @endif
                                        </p>
                                        <p class="text-muted mb-0 user-msg">
                                            @if(isset($notification->data['user']))
                                                <small>{{$notification->data['user']?$notification->data['user']:''}}</small>
                                            @endif
                                        </p>
                                    </a>
                                    <hr style="margin: 0px">
                                @endif
                            @endif
                        @empty
                            <a href="javascript:void(0);"
                               class="dropdown-item text-center text-primary notify-item notify-all">
                                {{ translate_title('No notifications', $lang)}}
                                <i class="fe-arrow-right"></i>
                            </a>
                        @endforelse
                    </div>
                    <!-- All-->
                    <a href="#"
                       class="dropdown-item text-center text-primary notify-item notify-all">
                        {{ translate_title('View all', $lang)}}
                        <i class="fe-arrow-right"></i>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                    <i class="fe-settings noti-icon"></i>
                </a>
            </li>
        </ul>
        <ul class="list-unstyled topnav-menu topnav-menu-left mb-0 menu_bar">
            <li>
                <a class="button-menu-mobile waves-effect">
                    <i class="fe-menu"></i>
                </a>
            </li>
            <li>
                <h5 class="mt-2">@yield('title')</h5>
            </li>
            <li>
                <a class="btn mt-2 mt-md-0 color_white" id="open_all_products_list" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                    <h6>
                        <i class="fe-search"></i>
                    </h6>
                </a>
            </li>
        </ul>
        <div class="clearfix"></div>

    </div>
    <!-- end Topbar -->
    <!-- ========== Left Sidebar Start ========== -->
    <div class="left-side-menu" >

        <div class="h-100">

            <!-- User box -->
            <div class="user-box text-center">
                @if($current_user)
                    @php
                        if(!$current_user->image){
                            $current_user->image = 'no';
                        }
                            $sms_avatar = storage_path('app/public/users/'.$current_user->image);
                    @endphp
                    @if(file_exists($sms_avatar))
                        <div class="d-flex justify-content-center">
                            <div class="rounded-circle avatar-md" style="background-image: url('{{asset('storage/users/'.$current_user->image)}}'); background-position:center; background-size:cover"></div>
                        </div>
                    @else
                        <div class="d-flex justify-content-center">
                            <div class="rounded-circle avatar-md" style="background-image: url('{{asset('images/man.jpg')}}'); background-position:center; background-size:cover"></div>
                        </div>
                    @endif
                @endif
                <div class="dropdown">
                    <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        @if($current_user)
                            {{$current_user->name?$current_user->name:''}} {{$current_user->surname?$current_user->surname:''}} {{$current_user->middlename?$current_user->middlename:''}}
                        @endif
                    </a>
                    <div class="dropdown-menu user-pro-dropdown">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-user me-1"></i>
                            <span>{{ translate_title('My Account', $lang)}}</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings me-1"></i>
                            <span>{{translate_title('Settings', $lang)}}</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-lock me-1"></i>
                            <span>Lock Screen</span>
                        </a>
                    </div>
                </div>
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a class="btn user_edit_logout"
                           href="#"><i class="mdi mdi-cog"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a  type="button" class="btn btn-warning user_edit_logout" data-bs-toggle="modal" data-bs-target="#logout-alert-modal" data-url="{{ route('logout') }}">
                            <i class="mdi mdi-power" style="color: red"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul id="side-menu">
                    <li>
                        <a href="{{route('cashier.index')}}">
                            <i class="mdi mdi mdi-home-outline me-1 me-1"></i>
                            <span> {{translate_title('Dashboard', $lang)}} </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('cashier-product.index')}}">
                            <i class="mdi mdi mdi-warehouse me-1 me-1"></i>
                            <span> {{translate_title('Warehouse', $lang)}} </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('indexSmall')}}">
                            <i class="mdi mdi-cash-register me-1"></i>
                            <span> {{translate_title('Cashbox small', $lang)}} </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('indexLarge')}}">
                            <i class="mdi mdi-cash-register me-1"></i>
                            <span> {{translate_title('Cashbox large', $lang)}} </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('payments')}}">
                            <i class="mdi mdi-cash-register me-1"></i>
                            <span> {{translate_title('Payments', $lang)}} </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('cashier-discount.index')}}">
                            <i class="mdi mdi-percent me-1"></i>
                            <span> {{translate_title('Discount', $lang)}} </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('gift-cards.index')}}">
                            <i class="mdi mdi-gift me-1"></i>
                            <span> {{translate_title('Gift cards', $lang)}} </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('clients.index')}}">
                            <i class="fa fa-user me-1"></i>
                            <span> {{translate_title('Client', $lang)}} </span>
                        </a>
                    </li>
                </ul>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

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

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    {{-- &copy; Adminto theme by <a href="">Coderthemes</a> --}}
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
<div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-body">
        <div class="card big_keyboard_card">
            <div class="card-body overflow-auto" style="padding: 4px 1rem !important;">
{{--                <div class="d-flex">--}}
                    <table class="restaurant_tables datatable table table-striped nowrap" id="all_products_list_for_selling">
                        <thead>
                            <tr>
                                <th class="barcode_title_column"><h6><b>{{translate_title('Barcode', $lang)}}</b></h6></th>
                                <th><h6><b>{{translate_title('Name', $lang)}}</b></h6></th>
                                <th><h6><b>{{translate_title('Price', $lang)}}</b></h6></th>
                                <th><h6><b>{{translate_title('Stock', $lang)}}</b></h6></th>
                            </tr>
                        </thead>
                        <tbody id="popover-container_">
                        @foreach($allProductsData['products'] as $product)
                            <tr onclick="addToOrder('{{$product['id']}}', '{{$product['name']}}', '{{$product['price']}}', '{{$product['discount']}}', '{{$product['discount_percent']}}', '{{$product['last_price']}}', '{{$product['amount']}}', '{{$product['barcode']}}', '{{$product['stock']}}', '{{$product['unit']}}', '{{$product['unit_id']}}', 1, null, null, null)">
                                <td class="market_tables_text_big barcode_number_column">
                                    <span><h6><b>{{$product['barcode']}}</b></h6></span>
                                </td>
                                <td class="market_tables_text_big">
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <h6>
                                                <a class="product_name word_wrap" tabindex="0" data-bs-container="#popover-container_" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="{{$product['name']}}" data-original-title="">{{$product['short_name']}}</a>
                                            </h6>
                                        </div>
                                        <div><h6><b>{{$product['amount']}}</b></h6></div>
                                    </div>
                                </td>
                                <td class="market_tables_text_big">
                                    <div class="d-flex">
                                        <span><h6><b>{{$product['last_price']}}</b></h6></span>
                                        @if($product['discount']>0)
                                            <del class="ms-2 withouth_discount_price"><h6><b>{{$product['price']}}</b></h6></del>
                                        @endif
                                    </div>
                                </td>
                                <td class="market_tables_text_big">
                                    <h6><b class="stock__quantity" id="stock__{{$product['id']}}">{{$product['stock']}}</b></h6>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <div class="accordion-body d-flex justify-content-center">
                                <div class="keyboard_big d-none" id="keyboard_en">
                                    <!-- Harflar raqamlar -->
                                    <div class="key_big"><h6>Q</h6></div><div class="key_big"><h6>W</h6></div>
                                    <div class="key_big"><h6>E</h6></div><div class="key_big"><h6>R</h6></div><div class="key_big"><h6>T</h6></div><div class="key_big"><h6>Y</h6></div>
                                    <div class="key_big"><h6>U</h6></div><div class="key_big"><h6>I</h6></div><div class="key_big"><h6>O</h6></div><div class="key_big"><h6>P</h6></div>
                                    <div class="key_big"><h6>[</h6></div><div class="key_big"><h6>]</h6></div><div class="key_big"><h6>-</h6></div><div class="key_big"><h6>_</h6></div>
                                    <div class="key_big ms-3"><h6>1</h6></div><div class="key_big ms-3"><h6>2</h6></div><div class="key_big ms-3"><h6>3</h6></div><div class="key_big ms-3"><h6>4</h6></div>

                                    <div class="key_big"><h6>A</h6></div><div class="key_big"><h6>B</h6></div><div class="key_big"><h6>D</h6></div><div class="key_big"><h6>F</h6></div>
                                    <div class="key_big"><h6>G</h6></div><div class="key_big"><h6>H</h6></div><div class="key_big"><h6>J</h6></div><div class="key_big"><h6>K</h6></div>
                                    <div class="key_big"><h6>L</h6></div><div class="key_big"><h6>;</h6></div>
                                    <div class="key_big"><h6>*</h6></div><div class="key_big"><h6>@</h6></div><div class="key_big"><h6>#</h6></div><div class="key_big"><h6>$</h6></div>
                                    <div class="key_big ms-3"><h6>5</h6></div><div class="key_big ms-3"><h6>6</h6></div><div class="key_big ms-3"><h6>7</h6></div><div class="key_big ms-3"><h6>8</h6></div>
                                    <div class="key_big"><h6>Z</h6></div><div class="key_big"><h6>X</h6></div>
                                    <div class="key_big"><h6>C</h6></div><div class="key_big"><h6>V</h6></div><div class="key_big"><h6>B</h6></div><div class="key_big"><h6>N</h6></div>
                                    <div class="key_big"><h6>M</h6></div><div class="key_big"><h6>{</h6></div><div class="key_big"><h6>}</h6></div><div class="key_big"><h6>/</h6></div>
                                    <div class="key_big"><h6>%</h6></div><div class="key_big"><h6>#</h6></div><div class="key_big"><h6>:</h6></div><div class="key_big"><h6>|</h6></div>
                                    <div class="key_big ms-3"><h6>9</h6></div><div class="key_big ms-3"><h6>0</h6></div><div class="key_big ms-3"><h6>,</h6></div><div class="key_big ms-3"><h6>.</h6></div>

                                    <!-- Raqamlar -->

                                    <div class="key_big"><h6>&</h6></div><div class="key_big"><h6>€</h6></div><div class="key_big"><h6>£</h6></div><div class="key_big"><h6>₩</h6></div><!-- Probel -->
                                    <div class="key_big"><h6>(</h6></div><div class="key_big"><h6>)</h6></div>
                                    <div class="d-flex justify-content-between width_244_pixel">
                                        <div class="key_space_big"><h6>Space</h6></div>
                                        <div class="key_space_big" onclick="clearKeyboardDisplay()"><h6>Clear</h6></div>
                                        <div class="key_space_big" onclick="backspaceKeyboard()"><h6><span class="mdi mdi-backspace"></span></h6></div>
                                    </div>
                                </div>
                                <div class="keyboard_big" id="keyboard_ru">
                                    <!-- Harflar raqamlar -->
                                    <div class="key_big"><h6>Й</h6></div><div class="key_big"><h6>Ц</h6></div>
                                    <div class="key_big"><h6>У</h6></div><div class="key_big"><h6>К</h6></div><div class="key_big"><h6>Е</h6></div><div class="key_big"><h6>Н</h6></div>
                                    <div class="key_big"><h6>Г</h6></div><div class="key_big"><h6>Ш</h6></div><div class="key_big"><h6>Щ</h6></div><div class="key_big"><h6>З</h6></div>
                                    <div class="key_big"><h6>[</h6></div><div class="key_big"><h6>]</h6></div><div class="key_big"><h6>-</h6></div><div class="key_big"><h6>_</h6></div>
                                    <div class="key_big ms-3"><h6>1</h6></div><div class="key_big ms-3"><h6>2</h6></div><div class="key_big ms-3"><h6>3</h6></div><div class="key_big ms-3"><h6>4</h6></div>
                                    <div class="key_big"><h6>Ф</h6></div><div class="key_big"><h6>Ы</h6></div><div class="key_big"><h6>В</h6></div><div class="key_big"><h6>А</h6></div>
                                    <div class="key_big"><h6>П</h6></div><div class="key_big"><h6>Р</h6></div><div class="key_big"><h6>О</h6></div><div class="key_big"><h6>Л</h6></div>
                                    <div class="key_big"><h6>Д</h6></div><div class="key_big"><h6>;</h6></div>
                                    <div class="key_big"><h6>*</h6></div><div class="key_big"><h6>@</h6></div><div class="key_big"><h6>#</h6></div><div class="key_big"><h6>$</h6></div>
                                    <div class="key_big ms-3"><h6>5</h6></div><div class="key_big ms-3"><h6>6</h6></div><div class="key_big ms-3"><h6>7</h6></div><div class="key_big ms-3"><h6>8</h6></div>
                                    <div class="key_big"><h6>Я</h6></div><div class="key_big"><h6>Ч</h6></div>
                                    <div class="key_big"><h6>С</h6></div><div class="key_big"><h6>М</h6></div><div class="key_big"><h6>И</h6></div><div class="key_big"><h6>Т</h6></div>
                                    <div class="key_big"><h6>Ь</h6></div><div class="key_big"><h6>{</h6></div><div class="key_big"><h6>}</h6></div><div class="key_big"><h6>/</h6></div>
                                    <div class="key_big"><h6>%</h6></div><div class="key_big"><h6>#</h6></div><div class="key_big"><h6>:</h6></div><div class="key_big"><h6>|</h6></div>
                                    <div class="key_big ms-3"><h6>9</h6></div><div class="key_big ms-3"><h6>0</h6></div><div class="key_big ms-3"><h6>,</h6></div><div class="key_big ms-3"><h6>.</h6></div>

                                    <!-- Raqamlar -->

                                    <div class="key_big"><h6>&</h6></div><div class="key_big"><h6>€</h6></div><div class="key_big"><h6>£</h6></div><div class="key_big"><h6>₩</h6></div><!-- Probel -->
                                    <div class="key_big"><h6>(</h6></div><div class="key_big"><h6>)</h6></div>
                                    <div class="d-flex justify-content-between width_244_pixel">
                                        <div class="key_space_big"><h6>Space</h6></div>
                                        <div class="key_space_big" onclick="clearKeyboardDisplay()"><h6>Clear</h6></div>
                                        <div class="key_space_big" onclick="backspaceKeyboard()"><h6><span class="mdi mdi-backspace"></span></h6></div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-end">
                                <div class="language_changer_content">
                                    <div class="square-switch">
                                        <input type="checkbox" id="keyboard_lang_change_func" switch="none" checked/>
                                        <label for="keyboard_lang_change_func" data-on-label="EN"
                                               data-off-label="RU"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                </div>--}}
            </div>
        </div>
    </div> <!-- end offcanvas-body-->
</div> <!-- end offcanvas-->

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

                    <!-- size -->
                    <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">{{ translate_title('Barcode on or off', $lang)}}</h6>
                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" id="barcode_on_or_off"/>
                        <label class="form-check-label" for="compact-check">{{ translate_title('Barcode', $lang)}} <small>{{ translate_title('(on or off)', $lang)}}</small></label>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content ps-4 pe-4">
            <div class="modal-header">
                <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="d-flex justify-content-between width_100_percent">
                <div class="text-start width_45_percent">
                    <div class="text-start mb-2 d-none" id="gift_card_sum_text">
                        <h6 class="me-auto">{{translate_title('Gift card sum', $lang)}}</h6>
                    </div>
                    <div class="text-start">
                        <h4 class="me-auto">{{translate_title('Payment sum', $lang)}}</h4>
                    </div>
                    <div class="text-start">
                        <h4 class="me-auto">{{translate_title('Accepting sum', $lang)}}</h4>
                    </div>
                    <div class="text-start">
                        <h4 class="me-auto">{{translate_title('Change sum', $lang)}}</h4>
                    </div>
                </div>
                <div class="text-center width_45_percent">
                    <div class="d-flex justify-content-center align-items-center mb-2 d-none" id="gift_card_sum_content">
                        <h6 id="gift_card_sum">0</h6>
                        <a type="button" class="btn delete_button btn-sm waves-effect ms-1" onclick="removeGiftCard()">
                            <img src="{{asset('img/trash_icon.png')}}" alt="" height="18px">
                        </a>
                    </div>
                    <h4 class="" id="payment_sum">0</h4>
                    <h4 class="" id="accepting_sum">0</h4>
                    <h4 class="" id="change_sum">0</h4>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <div class="me-3">
                    <div class="d-flex position-relative justify-content-between">
                        <h5>{{translate_title('Наличие', $lang)}}</h5>
                        <input id="display" class="input-display-lg form-control" value="0" type="text">
                    </div>
                    <div class="d-flex position-relative justify-content-between">
                        <h5>{{translate_title('Карта', $lang)}}</h5>
                        <input id="display_card" class="input-display-lg form-control" value="0" type="text">
                    </div>
                    <div class="d-flex position-relative justify-content-between" id="debt_display_content">
                        <h5>{{translate_title('Долг', $lang)}}</h5>
                        <input id="debt_display" class="input-display-lg form-control" value="0" type="text">
                    </div>
                    <div class="d-flex position-relative justify-content-between" id="_display_content">
                        <div>
                            <h6 class="font-14">{{translate_title('Gift card', $lang)}}</h6>
                            <div class="d-flex align-items-center mt-1">
                                <div class="square-switch">
                                    <input type="checkbox" id="gift_card_change_func" switch="none"/>
                                    <label for="gift_card_change_func" data-on-label="On"
                                           data-off-label="Off"></label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between d-none mt-2" id="gift_card_content">
                            <input id="gift_card_input" class="input-display-lg form-control" placeholder="Enter promocode" value="" type="text">
                            <button class="btn modal_confirm_ height_38" onclick="giftCardConfirm()" id="giftCardConfirmButton">ok</button>
                        </div>
                    </div>
                </div>
                <div class="width_344_pixel">
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
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <a class="btn modal_close_ height_50 me-4" data-bs-dismiss="modal">{{translate_title('Close', $lang)}}</a>
                <button class="btn modal_confirm_ height_50" data-bs-dismiss="modal" onclick="paymentPayFunc(null)">{{translate_title('Payment', $lang)}}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Standard modal content -->
<div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel"></h4>
                <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-light" data-bs-dismiss="modal">{{ translate_title('Close', $lang) }}</a>
                <a type="button" class="btn btn-primary">{{ translate_title('Save changes', $lang) }}</a>
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
                            <input id="display_password" type="text" class="input-display_password form-control" value="">
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
<script>
    let items_selected_text = "{{translate_title('items selected', $lang)}}"
    let search_client_text = "{{translate_title('Поиск', $lang)}}"
    let keyboard_lang_change_func = document.getElementById('keyboard_lang_change_func')
    let gift_card_change_func = document.getElementById('gift_card_change_func')
    let gift_card_content = document.getElementById('gift_card_content')
    let gift_card_sum_content = document.getElementById('gift_card_sum_content')
    let keyboard_selected_lang = localStorage.getItem('selected_lang')
    let keyboard_ru = document.getElementById('keyboard_ru')
    let keyboard_en = document.getElementById('keyboard_en')

    if(keyboard_selected_lang == 'ru'){
        keyboard_lang_change_func.click()
    }

    keyboard_lang_change_func.addEventListener('change', function (e) {
        if(e.target.value == 'on'){
            keyboardChangerFunc()
        }
    })
    function keyboardChangerFunc(){
        if(keyboard_selected_lang != undefined && keyboard_selected_lang != null){
            if(keyboard_selected_lang == 'en'){
                openRuKeyboardFunc()
            }else if(keyboard_selected_lang == 'ru'){
                openEnKeyboardFunc()
            }else{
                openEnKeyboardFunc()
            }
        }else{
            openEnKeyboardFunc()
        }
    }

    function openRuKeyboardFunc(){
        localStorage.setItem('selected_lang', 'ru')
        keyboard_selected_lang = 'ru'
        if(!keyboard_en.classList.contains('d-none')){
            keyboard_en.classList.add('d-none')
        }
        if(keyboard_ru.classList.contains('d-none')){
            keyboard_ru.classList.remove('d-none')
        }
    }

    function openEnKeyboardFunc(){
        localStorage.setItem('selected_lang', 'en')
        keyboard_selected_lang = 'en'
        if(!keyboard_ru.classList.contains('d-none')){
            keyboard_ru.classList.add('d-none')
        }
        if(keyboard_en.classList.contains('d-none')){
            keyboard_en.classList.remove('d-none')
        }
    }

    gift_card_change_func.addEventListener('change', function (e) {
        if(e.target.value == 'on'){
            giftCardChangerFunc()
        }
    })

    function giftCardChangerFunc(){
        if(gift_card_content.classList.contains('d-none')){
            gift_card_content.classList.remove('d-none')
        }else{
            gift_card_content.classList.add('d-none')
        }
        if(gift_card_sum.innerText.length>1){
            if(gift_card_sum_content.classList.contains('d-none')){
                gift_card_sum_content.classList.remove('d-none')
            }else{
                gift_card_sum_content.classList.add('d-none')
            }
            if(gift_card_sum_text.classList.contains('d-none')){
                gift_card_sum_text.classList.remove('d-none')
            }else{
                gift_card_sum_text.classList.add('d-none')
            }
        }
    }
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
    let carousel_product_images = document.getElementById('carousel_product_images')
    function getImages(images) {
        let all_images = images.split(' ')
        let images_content = ''
        for(let i=0; i<all_images.length; i++){
            if(i == 0){
                images_content = images_content +
                    `<div class="carousel-item active">
                        <img class="d-block img-fluid" src="${all_images[i]}" alt="First slide">
                    </div>`
            }else{
                images_content = images_content +
                    `<div class="carousel-item">
                            <img class="d-block img-fluid" src="${all_images[i]}" alt="First slide">
                        </div>`
            }
        }
        if(carousel_product_images != undefined && carousel_product_images != null){
            carousel_product_images.innerHTML = images_content
        }
    }
</script>
<script src="{{ asset('js/dark-light.js') }}"></script>
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
<script src="{{ asset('libs/tippy.js/tippy.all.min.js') }}"></script>

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
<script src="{{asset('js/cashbox_big.js')}}"></script>
</body>
<script>
    let open_all_products_list = document.getElementById('open_all_products_list')
    removeClientDiscount.addEventListener('click', function () {
        $(document).ready(function () {
            if($('#client_select_id_2') != undefined && $('#client_select_id_2') != null){
                $('#client_select_id_2').val(null).trigger('change')
            }
        })
    })
    open_all_products_list.addEventListener('click', function () {
        setTimeout(function () {
            let all_products_list_input = document.querySelector("#offcanvasTop input[type='search'][aria-controls='all_products_list_for_selling']")
            all_products_list_input.value = '';
            all_products_list_input.focus();
            all_products_list_input.addEventListener("blur", (event) => {
                event.preventDefault(); // Fokusni saqlash
                all_products_list_input.focus();
            });
        }, 444)
    })
    // if (window.innerWidth < 1000) {
    //     $(document).ready(function () {
    //         setTimeout(function () {
    //             $('.navbar-custom .menu_bar .button-menu-mobile').trigger('click')
    //             console.log('yopildi')
    //         }, 144)
    //     })
    // }
</script>
</html>
