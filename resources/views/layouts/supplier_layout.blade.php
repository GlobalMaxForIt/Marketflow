@php
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
</head>
<body class="main">
<div class="background_transparent display-none"></div>
<div class="content row">
    <div class="main_menu col-1">
        <div class="d-flex flex-column justify-content-between">
            <div class="main-menu-top_buttons">
                <a class="main-menu-top-buttons-link-main" href="{{route('dashboard')}}">
                    <img class="main-menu-top-buttons_logo" src="{{asset('img/img-logo.png')}}" alt="">
                </a>
                <a class="main-menu-top-buttons_link" href="{{route('users.index')}}">
                    <div class="main-menu-buttons_link-img">
                        @if(isset($current_page))
                            @if($current_page == 'employees')
                                <img src="{{asset('menubar/employee_active.png')}}" alt="">
                            @else
                                <img src="{{asset('menubar/employee.png')}}" alt="">
                            @endif
                        @else
                            <img src="{{asset('menubar/employee.png')}}" alt="">
                        @endif
                    </div>
                    <span class="main-menu-top-buttons-link_text @if(isset($current_page)) {{$current_page == 'employees'?'active':''}} @endif">{{translate_title('Employees', $lang)}}</span>
                </a>
                <a class="main-menu-top-buttons_link" href="{{route('product.index')}}">
                    <div class="main-menu-buttons_link-img">
                        @if(isset($current_page))
                            @if($current_page == 'products')
                                <img src="{{asset('menubar/products_active.png')}}" alt="">
                            @else
                                <img src="{{asset('menubar/products.png')}}" alt="">
                            @endif
                        @else
                            <img src="{{asset('menubar/products.png')}}" alt="">
                        @endif
                    </div>
                    <span class="main-menu-top-buttons-link_text @if(isset($current_page)) {{$current_page == 'products'?'active':''}} @endif">{{translate_title('Products', $lang)}}</span>
                </a>
                <a class="main-menu-top-buttons_link" href="{{route('discount.index')}}">
                    <div class="main-menu-buttons_link-img">
                        @if(isset($current_page))
                            @if($current_page == 'discount')
                                <img src="{{asset('menubar/discount_active.png')}}" alt="">
                            @else
                                <img src="{{asset('menubar/discount.png')}}" alt="">
                            @endif
                        @else
                            <img src="{{asset('menubar/discount.png')}}" alt="">
                        @endif
                    </div>
                    <span class="main-menu-top-buttons-link_text @if(isset($current_page)) {{$current_page == 'discount'?'active':''}} @endif">{{translate_title('Discount', $lang)}}</span>
                </a>
                <a class="main-menu-top-buttons_link mb-1" href="{{route('language.index')}}">
                    <div class="main-menu-buttons_link-img">
                        @if(isset($current_page))
                            @if($current_page == 'settings')
                                <img src="{{asset('menubar/settings_active.png')}}" alt="">
                            @else
                                <img src="{{asset('menubar/settings.png')}}" alt="">
                            @endif
                        @else
                            <img src="{{asset('menubar/settings.png')}}" alt="">
                        @endif
                    </div>
                    <span class="main-menu-top-buttons-link_text @if(isset($current_page)) {{$current_page == 'settings'?'active':''}} @endif">{{translate_title('Settings', $lang)}}</span>
                </a>
            </div>
            <div class="main-menu-bottom_buttons">
                <a class="main-menu-bottom-buttons_link mb-4" href="#">
                    <div class="main-menu-buttons_link-img">
                        <div class="main-menu-buttons_link-img_circle"></div>
                    </div>
                </a>
                <a class="main-menu-bottom-buttons_link">
                    <div class="main-menu-buttons_link-img">
                        <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#logout-alert-modal" style="border: 0px; background-color: transparent; color: #98a6ad">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 15H16.875M7.5 18.75L3.75 15L7.5 11.25M13.75 8.75V7.5C13.75 6.83696 14.0134 6.20107 14.4822 5.73223C14.9511 5.26339 15.587 5 16.25 5H22.5C23.163 5 23.7989 5.26339 24.2678 5.73223C24.7366 6.20107 25 6.83696 25 7.5V22.5C25 23.163 24.7366 23.7989 24.2678 24.2678C23.7989 24.7366 23.163 25 22.5 25H16.25C15.587 25 14.9511 24.7366 14.4822 24.2678C14.0134 23.7989 13.75 23.163 13.75 22.5V21.25" stroke="#121212" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="main_content col-11">
        <div class="row">
            <div class="col-9">
                <div class="main-content-header">
                    <div class="width_74_percent d-flex justify-content-between me-4">
                        <input class="input-default main-content-header_search" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Поиск товара" type="text">
                        <img class="input_icon_" src="{{asset('icon/header_search.png')}}" alt="" height="20px">
                        <div class="main-content-header_search_circle">
                            <img src="{{asset('icon/header_category.png')}}" alt="" height="20px">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="main-content-header">
                    <div class="d-flex align-items-center">
                        <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.26446 1.3965L2.34796 8.424C2.19626 8.57733 2.11118 8.78431 2.11118 9C2.11118 9.21569 2.19626 9.42267 2.34796 9.576L9.26296 16.6035C9.41457 16.7578 9.49952 16.9654 9.49952 17.1817C9.49952 17.3981 9.41457 17.6057 9.26296 17.76C9.18889 17.836 9.10037 17.8963 9.0026 17.9376C8.90484 17.9788 8.79981 18 8.6937 18C8.5876 18 8.48258 17.9788 8.38481 17.9376C8.28705 17.8963 8.19852 17.836 8.12446 17.76L1.20946 10.734C0.755067 10.2712 0.500488 9.64856 0.500488 9C0.500488 8.35143 0.755067 7.72878 1.20946 7.266L8.12446 0.239999C8.19854 0.163796 8.28716 0.103223 8.38507 0.0618607C8.48297 0.0204986 8.58817 -0.000812531 8.69446 -0.000812531C8.80074 -0.000812531 8.90594 0.0204986 9.00385 0.0618607C9.10175 0.103223 9.19037 0.163796 9.26446 0.239999C9.41607 0.394282 9.50102 0.601939 9.50102 0.818249C9.50102 1.03456 9.41607 1.24222 9.26446 1.3965Z" fill="#C1C1C1"/>
                        </svg>
                        <span class="table_title ms-3">{{$title}}</span>
                    </div>
                    <div class="align-items-center d-flex" id="lang-change">
                        <a class="buttonUzbDropDownHeader" type="button" id="dropdownMenuButton" role="button">
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
                            <span>{{strtoupper($locale)}}</span>
                            <svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.39646 0.735498L8.42396 7.652C8.57729 7.80369 8.78427 7.88877 8.99996 7.88877C9.21564 7.88877 9.42262 7.80369 9.57596 7.652L16.6035 0.736999C16.7577 0.585385 16.9654 0.500431 17.1817 0.500431C17.398 0.500431 17.6057 0.585385 17.76 0.736999C17.8359 0.811065 17.8963 0.899588 17.9375 0.997354C17.9788 1.09512 18 1.20015 18 1.30625C18 1.41235 17.9788 1.51738 17.9375 1.61514C17.8963 1.71291 17.8359 1.80143 17.76 1.8755L10.734 8.7905C10.2712 9.24489 9.64852 9.49947 8.99996 9.49947C8.35139 9.49947 7.72874 9.24489 7.26596 8.7905L0.239957 1.8755C0.163754 1.80141 0.103181 1.71279 0.0618187 1.61489C0.0204566 1.51699 -0.000854492 1.41178 -0.000854492 1.3055C-0.000854492 1.19922 0.0204566 1.09401 0.0618187 0.996109C0.103181 0.898205 0.163754 0.809587 0.239957 0.735498C0.39424 0.583884 0.601897 0.49893 0.818207 0.49893C1.03452 0.49893 1.24217 0.583884 1.39646 0.735498Z" fill="#121212"/>
                            </svg>
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
                                            <img class="dropdownRegionBayroq" id="lang_uz" style="margin-right: 8px;" src="{{asset('/images/language/region.png')}}" alt="region">
                                            {{ $language->name??'' }}
                                            @break

                                            @case('ru')
                                            <img class="dropdownRegionBayroq" id="lang_ru" style="margin-right: 8px;"
                                                 src="{{ asset('/images/language/RU.png') }}" alt="region">
                                            {{ $language->name??'' }}
                                            @break

                                            @case('en')
                                            <img class="dropdownRegionBayroq" id="lang_en" style="margin-right: 8px;"
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
            </div>
        </div>
        @yield('content')
    </div>
</div>

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
</body>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>

    @if($notifications['current_user'])
        let current_user_id = "{{$notifications['current_user']->id}}"
        let token = "{{$notifications['current_user']->token}}"
    @else
        let current_user_id = ""
        let token = ""
    @endif
    let get_notifications_url = "{{route('getNotification')}}"
    let cashier_product_url = "{{route('cashier-product.show', '=')}}"
    let no_notification_text = "{{translate_title('No notifications', $lang)}}"
    let unread_notifications_quantity = document.getElementById('unread_notifications_quantity')
    let current_user_notifications = document.getElementById('current_user_notifications')
    let current_user_no_notifications = document.getElementById('current_user_no_notifications')
</script>
<script src="{{asset('js/pusher_commands.js')}}"></script>
<script>
    let items_selected_text = "{{translate_title('items selected', $lang)}}"
    let search_client_text = "{{translate_title('Поиск', $lang)}}"

    $(document).ready(function() {

        let uz = `{{ asset('/images/language/region.png') }}`
        let ru = `{{ asset('/images/language/RU.png') }}`
        let en = `{{ asset('/images/language/GB.png') }}`

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

                    $.post("{{ route('language.change') }}", {
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
        console.log(images)
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
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/datatables_style.js') }}"></script>
<script>
    $(document).ready(function () {
        let sessionSuccess ="{{session('status')}}";
        if(sessionSuccess){
            toastr.success(sessionSuccess)
        }
        let sessionError ="{{session('error')}}";
        if(sessionError){
            toastr.warning(sessionError)
        }
    })
</script>


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


<!-- Plugins js -->

</html>
