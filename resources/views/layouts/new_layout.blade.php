<!DOCTYPE html>
<html lang="en">
@php
    $current_user = \Illuminate\Support\Facades\Auth::user();
    $locale = app()->getLocale();
//    $language = ['en', 'uz', 'ru'];

@endphp
<head>
    <meta charset="utf-8" />
    <title>{{ '4u2' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    <link href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}" type="text/css" rel="stylesheet"/>
    <!-- third party css -->
    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style"/>
    {{-- Main css --}}
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">


    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    {{--    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>--}}
    {{--    <script>--}}
    {{--        Pusher.logToConsole = true;--}}

    {{--        // in blade.php--}}
    {{--        var pusher = new Pusher('4bf904d1d86b8b8ff046', {--}}
    {{--            cluster: 'ap1'--}}
    {{--        });--}}

    {{--        var channel = pusher.subscribe('4u2-channel');--}}
    {{--        channel.bind('4u2-event', function(data) {--}}
    {{--            console.log(data)--}}
    {{--            // alert(JSON.stringify(data))--}}
    {{--            alert('Xurshid kurrani kuti')--}}
    {{--            // toastr.success(data)--}}
    {{--        });--}}
    {{--        // Enable pusher logging - don't include this in production--}}
    {{--    </script>--}}
</head>
<style>
    #dropdownMenuButton{
        z-index: 1;
    }

    .buttons-pdf, .buttons-copy{
        display: none;
    }

</style>
<!-- body start -->

<body class="loading" data-layout-color="light" data-layout-mode="default" data-layout-size="fluid" id="body_layout"
      data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default'
      data-sidebar-user='true'>
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
                        <form class="d-flex justify-content-between" action="{{route('order.make_all_notifications_as_read')}}" method="POST" id="perform_order">
                            @csrf
                            @method('POST')
                            <a type="button" class="btn btn-danger my-2" data-bs-dismiss="modal"> {{ translate_title('No', $lang)}}</a>
                            <button type="submit" class="btn btn-success my-2"> {{ translate_title('Yes', $lang)}} </a>
                        </form>
                    </div>
                </div>
            </div>

        </div><!-- /.modal-dialog -->
    </div>
    <!-- Topbar Start -->
    <div class="navbar-custom">
        <ul class="list-unstyled topnav-menu float-end mb-0">
            <li class="d-none d-lg-block">
                {{--                        <form action="{{route('test')}}" method="POST">--}}
                {{--                            @csrf--}}
                {{--                            @method('POST')--}}
                {{--                            <button type="submit">submit</a>--}}
                {{--                        </form>--}}

                <form class="app-search">
                    <div class="app-search-box">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search..." id="top-search">
                            <a class="btn input-group-text" type="submit">
                                <i class="fe-search"></i>
                            </a>
                        </div>
                        <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h5 class="text-overflow mb-2">{{translate_title('Found 22 results', $lang)}}</h5>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-home me-1"></i>
                                <span>{{translate_title('Analytics Report', $lang)}}</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-aperture me-1"></i>
                                <span>{{translate_title('How can I help you?', $lang)}}</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-settings me-1"></i>
                                <span>{{translate_title('User profile settings', $lang)}}</span>
                            </a>

                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow mb-2 text-uppercase">{{translate_title('Users', $lang)}}</h6>
                            </div>

                            <div class="notification-list">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="d-flex align-items-start">
                                        <img class="d-flex me-2 rounded-circle" src="{{ asset('assets/images/user/user-2.jpg') }}"
                                             alt="Generic placeholder image" height="32">
                                        <div class="w-100">
                                            <h5 class="m-0 font-14">Erwin E. Brown</h5>
                                            <span class="font-12 mb-0">{{translate_title('UI Designer', $lang)}}</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="d-flex align-items-start">
                                        <img class="d-flex me-2 rounded-circle" src="{{ asset('assets/images/user/user-5.jpg') }}"
                                             alt="Generic placeholder image" height="32">
                                        <div class="w-100">
                                            <h5 class="m-0 font-14">Jacob Deo</h5>
                                            <span class="font-12 mb-0">{{translate_title('Developer', $lang)}}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </form>
            </li>
            <li class="">
                <div>

                    <div class="align-items-stretch d-flex dropdown" id="lang-change">
                        <a class="buttonUzbDropDownHeader dropdown-toggle" type="button" id="dropdownMenuButton" role="button"
                           data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" href="javascript:void(0);">
                            @switch($locale)
                                @case('uz')
                                <img class="notifRegion2" id="selected_language"
                                     src="{{ asset('/assets/images/language/region.png') }}" alt="region">
                                @break

                                @case('en')
                                <img class="notifRegion2" id="selected_language"
                                     src="{{ asset('/assets/images/language/GB.png') }}" alt="region">
                                @break

                                @case('ru')
                                <img class="notifRegion2" id="selected_language"
                                     src="{{ asset('/assets/images/language/RU.png') }}" alt="region">
                                @break
                            @endswitch
                        </a>
                        <div id="language_flag" class="language_flag display-none"
                             style="border: none; background-color: transparent;" aria-labelledby="dropdownMenuButton">
                            <div class="up-arrow"></div>
                            <div class="dropdownMenyApplyUzbFlag">
                                @foreach (\App\Models\Language::all() as $key => $language)
                                    <a href="javascript:void(0)" data-flag="{{ $language->code??'' }}"
                                       class="dropdown-item dropdown-item dropdownLanguageItem @if ($locale == $language->code??'') active @endif" >
                                        @switch($language->code)
                                            @case('uz')
                                            <img class="dropdownRegionBayroq" id="lang_uz" style="margin-right: 8px;" src="{{asset('/assets/images/language/region.png')}}" alt="region">
                                            {{ $language->name??'' }}
                                            @break

                                            @case('ru')
                                            <img class="dropdownRegionBayroq" id="lang_ru" style="margin-right: 8px;"
                                                 src="{{ asset('/assets/images/language/RU.png') }}" alt="region">
                                            {{ $language->name??'' }}
                                            @break

                                            @case('en')
                                            <img class="dropdownRegionBayroq" id="lang_en" style="margin-right: 8px;"
                                                 src="{{ asset('/assets/images/language/GB.png') }}" alt="region">
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
            <li class="dropdown d-inline-block d-lg-none">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown"
                   href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fe-search noti-icon"></i>
                </a>
                <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                    <form class="p-3">
                        <input type="text" class="form-control" placeholder="Search ..."
                               aria-label="Recipient's username">
                    </form>
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
                                    <a href="{{route('order.index', 2)}}" class="dropdown-item notify-item">
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
                    <a href="{{route('order.index', 2)}}"
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
                <h4>@yield('title')</h4>
            </li>
        </ul>
        <div class="clearfix"></div>

    </div>
    <!-- end Topbar -->
    <!-- ========== Left Sidebar Start ========== -->
    <div class="left-side-menu" style="overflow: scroll; z-index: 1004; margin-top: -70px">

        <div class="h-100">

            <!-- User box -->
            <div class="user-box text-center">
                @if($current_user)
                    @php
                        if(!$current_user->avatar){
                            $current_user->avatar = 'no';
                        }
                            $sms_avatar = storage_path('app/public/user/'.$current_user->avatar);
                    @endphp
                    @if(file_exists($sms_avatar))
                        <img class="rounded-circle img-thumbnail avatar-md" src="{{asset('storage/user/'.$current_user->avatar)}}" alt="">
                    @else
                        <img class="rounded-circle img-thumbnail avatar-md" src="{{asset('images/man.jpg')}}" alt="">
                    @endif
                @endif
                <div class="dropdown">
                    <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        @if($current_user)
                            {{$current_user->first_name?$current_user->first_name:''}} {{$current_user->last_name?$current_user->last_name:''}}
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

                        <!-- item-->
                        {{--                            <form action="{{route('logout')}}" method="POST">--}}
                        {{--                                @csrf--}}
                        {{--                                @method("POST")--}}
                        {{--                                <a class="dropdown-item notify-item" type="submit">--}}
                        {{--                                    <i class="fe-log-out me-1"></i>--}}
                        {{--                                    <span>{{translate_title('Logout', $lang)}}</span>--}}
                        {{--                                </a>--}}
                        {{--                            </form>--}}
                    </div>
                </div>

                {{-- <p class="text-muted left-user-info">{{$current_user->role->name??''}}</p> --}}

                <ul class="list-inline">
                    <li class="list-inline-item dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user d-flex me-0 waves-effect waves-light mt-8"
                           href="{{route('getUser')}}"><i class="mdi mdi-cog"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-center profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">{{ translate_title('Welcome !', $lang)}}</h6>
                            </div>

                            <!-- item-->
                        {{--                                <a href="{{route('account')}}" class="dropdown-item notify-item">--}}
                        {{--                                    <i class="fe-user"></i>--}}
                        {{--                                    <span>{{translate_title('My Account', $lang)}}</span>--}}
                        {{--                                </a>--}}

                        <!-- item-->
                            <a href="auth-lock-screen.html" class="dropdown-item notify-item">
                                <i class="fe-lock"></i>
                                <span>{{ translate_title('Lock Screen', $lang)}}</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            {{--                                <form action="{{route('logout')}}" method="POST">--}}
                            {{--                                    @csrf--}}
                            {{--                                    @method("POST")--}}
                            {{--                                    <a class="dropdown-item notify-item" type="submit">--}}
                            {{--                                        <i class="fe-log-out"></i>--}}
                            {{--                                        <span>{{translate_title('Logout', $lang)}}</span>--}}
                            {{--                                    </a>--}}
                            {{--                                </form>--}}
                        </div>
                    </li>
                    <li class="list-inline-item">
                        <a  type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#logout-alert-modal" data-url="{{ route('logout') }}" style="border: 0px; background-color: transparent; color: #98a6ad">
                            <i class="mdi mdi-power" style="color: red"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul id="side-menu">
                    <li>
                        <a href="#">
                            <i class="mdi mdi-home-outline"></i>
                            <span class="badge bg-success rounded-pill float-end">9+</span>
                            <span> {{translate_title('Home', $lang)}} </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="mdi mdi-order-bool-ascending"></i>
                            <!-- <span class="badge bg-success rounded-pill float-end">9+</span> -->
                            {{-- <span> Order </span> --}}
                            <span> {{ translate_title('Order', $lang) }} </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="mdi mdi-account-star-outline"></i>
                            <span> {{ translate_title('Users', $lang) }} </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="mdi mdi-checkbox-blank-circle-outline"></i>
                            <span> {{ translate_title('Color', $lang) }} </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="mdi mdi-map-marker-outline"></i>
                            <span> {{ translate_title('Pick up point', $lang) }} </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="mdi mdi-account-outline"></i>
                            <span> {{ translate_title('Sizes', $lang) }} </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="mdi mdi-basket-outline"></i>
                            <span> {{ translate_title('Products', $lang) }} </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="mdi mdi-percent-outline"></i>
                            <span> {{ translate_title('Discount', $lang) }} </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="mdi mdi-gift-outline"></i>
                            <span> {{ translate_title('Coupon', $lang) }} </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="mdi mdi-shopping-outline"></i>
                            <span> {{ translate_title('Characterized products', $lang) }} </span>
                        </a>
                    </li>
                    <li>
                        <a href="#categoryMenus" data-bs-toggle="collapse">
                            <i class="mdi mdi-format-list-bulleted"></i>
                            <span> {{ translate_title('Category', $lang) }} </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="categoryMenus">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="#">
                                        <i class="mdi mdi-format-list-bulleted"></i>
                                        <span> {{ translate_title('Category', $lang) }} </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="mdi mdi-format-list-bulleted"></i>
                                        <span> {{ translate_title('Sub Category', $lang) }} </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="mdi mdi-format-list-bulleted"></i>
                                        <span> {{ translate_title('Sub Sub Category', $lang) }} </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#settings" data-bs-toggle="collapse">
                            <i class="fe-settings noti-icon"></i>

                            <span> {{translate_title('Settings', $lang)}} </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="settings">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{route('language.index')}}"> {{translate_title('Language', $lang)}}  </a>
                                </li>
                                <li>
                                    <a href="{{route('table.index')}}"> {{translate_title('Table translations', $lang)}}  </a>
                                </li>
                                <li>
                                    <a href="#">{{translate_title('Payment status', $lang)}}</a>
                                </li>
                            </ul>
                        </div>
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
                {{-- <div class="card">
                    <div class="card-body"> --}}

                @yield('content')

                {{-- </div>
            </div> --}}
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
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

<!-- END wrapper -->

<!-- Right Sidebar -->
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
<!-- /Right-bar -->


<!-- Warning Alert Modal FOR DELETE -->
<div id="warning-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <i class="dripicons-warning h1 text-warning"></i>
                    <h4 class="mt-2">{{ translate_title('Are you sure delete this data', $lang)}}</h4>
                    <form style="display: inline-block;" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <a type="button" class="btn btn-danger my-2" data-bs-dismiss="modal"> {{ translate_title('No', $lang)}}</a>
                        {{-- <a type="button" class="btn btn-danger my-2" data-bs-dismiss="modal">{{ translate_title('No', $lang) }}</a> --}}
                        <button type="submit" class="btn btn-success my-2"> {{ translate_title('Yes', $lang)}} </button>
                        {{-- <button type="submit" class="btn btn-warning my-2">{{ translate_title('Yes', $lang) }}</a> --}}
                    </form>
                    {{-- <a type="button" class="btn btn-warning my-2" data-bs-dismiss="modal">Continue</a> --}}
                </div>
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


<!-- Standard modal content -->
<div id="standard-modal-admin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
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

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>


<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>
    let current_page = "{{$current_page}}"
</script>
<script src="{{asset('js/pusher_commands.js')}}"></script>
<script>

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


    let dropdownMenuButton = document.getElementById('dropdownMenuButton')
    let language_flag = document.getElementById('language_flag')
    // let wrapper = document.getElementById('wrapper')
    // wrapper.addEventListener('click', function() {
    //     if (language_flag.classList.contains('display-none')) {
    //         language_flag.classList.add('display-none')
    //     }
    // });
    dropdownMenuButton.addEventListener('click', function() {
        if (language_flag.classList.contains('display-none')) {
            language_flag.classList.remove('display-none')
        } else {
            language_flag.classList.add('display-none')
        }
    });
</script>
<script src="{{ asset('js/dark-light.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/datatables_style.js') }}"></script>
<!-- Vendor -->
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
